let Product = {
    id: 0,
    url: {
        list: `${url}/admin/product/list`,
        requests: `${url}/admin/product/requests`,
        archive: `${url}/admin/product/archive`
    },
    productList: (product) => {
        return `
            <tr id='product_${product.id}'>
                <td>${product.code}</td>
                <td>${product.name}</td>
                <td>$ ${product.price}.00</td>
                <td>$ ${product.srp}.00</td>
                <td>${product.discount}%</td>
                <td>${product.quantity} pcs</td>
                <td>$ ${product.delivery_fee}.00</td>
                <td>${product.store.name}</td>
                <td>
                    <button class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="findProduct('${product.id}')">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button class="btn btn-danger" onclick="archiveProduct('${product.id}')"><i class="fa fa-times"></i></button>
                </td>
            </tr>   
        `;
    },
    productRow: (product, store_name) => {
        return `
            <td>${product.code}</td>
            <td>${product.name}</td>
            <td>$ ${product.price}.00</td>
            <td>$ ${product.srp}.00</td>
            <td>${product.discount}%</td>
            <td>${product.quantity} pcs</td>
            <td>$ ${product.delivery_fee}.00</td>
            <td>${store_name}</td>
            <td>
                <button class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="findProduct('${product.id}')">
                    <i class="fa fa-pencil"></i>
                </button>
                <button class="btn btn-danger" onclick="archiveProduct('${product.id}')"><i class="fa fa-times"></i></button>
            </td>
        `; 
    },
    productRequest: (product) => {
        return `
            <tr id='product_${product.id}'>
                <td>${product.code}</td>
                <td>${product.name}</td>
                <td>$ ${product.price}.00</td>
                <td>$ ${product.srp}.00</td>
                <td>${product.discount}%</td>
                <td>${product.quantity} pcs</td>
                <td>$ ${product.delivery_fee}.00</td>
                <td>${product.store.name}</td>
                <td>
                    <button class="btn btn-success" onclick="acceptRequest('${product.id}')"><i class="fa fa-check"></i></button>
                    <button class="btn btn-danger" onclick="declineRequest('${product.id}')"><i class="fa fa-times"></i></button>
                </td>
            </tr>   
        `;
    },
    productArchive: (product) => {
        return `
            <tr id='product_${product.id}'>
                <td>${product.code}</td>
                <td>${product.name}</td>
                <td>$ ${product.price}.00</td>
                <td>$ ${product.srp}.00</td>
                <td>${product.discount}%</td>
                <td>${product.quantity} pcs</td>
                <td>$ ${product.delivery_fee}.00</td>
                <td>${product.store.name}</td>
                <td>
                    <button class="btn btn-success" onclick="removeArchive('${product.id}')"><i class="fa fa-recycle"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                </td>
            </tr>   
        `;
    },
}

function getProductList() {
    loader();
    $.ajax({
        type: 'get',
        url: Product.url.list
    }).done(res => {
        swal.close();
        console.clear();
        console.log(res);
        Product.url.list = res.products.next_page_url;
        if (res.products.next_page_url == null) {
            $('#view_more_product_list_btn').remove();
        }
        for(var x in res.products.data) {
            $('#product_list_container').append(Product.productList(res.products.data[x]));
        }
    }).fail(err => {
        console.log(err);
    });
}

$('#search_product_list_form').on('submit', function(e) {
    e.preventDefault();
    loader();
    let data = $('#search_product_list_input').val();
    $.ajax({
        type: 'get',
        url: `${url}/admin/product/list/data=${data}`
    }).done(res => {
        swal.close();
        console.log(res);
        $('#search_product_list_input').val("");
        $('#searched_product_list_container tr').remove();
        if (res.products.next_page_url == null) {
            $('#view_more_searched_product_list_btn').remove();
        }
        for(var x in res.products.data) {
            $('#searched_product_list_container').append(Product.productList(res.products.data[x]));
        }
    }).fail(err => {
        console.log(err);
    });
});

function getProductRequests() {
    loader();
    $.ajax({
        type: 'get',
        url: Product.url.requests
    }).done(res => {
        swal.close();
        console.clear();
        console.log(res);
        Product.url.requests = res.products.next_page_url;
        if (res.products.next_page_url == null) {
            $('#view_more_product_request_btn').remove();
        }
        for(var x in res.products.data) {
            $('#product_request_container').append(Product.productRequest(res.products.data[x]));
        }
    }).fail(err => {
        console.log(err);
    })
}

$('#search_product_request_form').on('submit', function(e) {
    e.preventDefault();
    loader();
    let data = $('#search_product_request_input').val()
    $.ajax({
        type: 'get',
        url: `${url}/admin/product/requests/data=${data}`
    }).done(res => {
        swal.close();
        $('#search_product_request_input').val("");
        $('#searched_product_request_container tr').remove();
        for(var x in res.products.data) {
            $('#searched_product_request_container').append(Product.productRequest(res.products.data[x]));
        }
    }).fail(err => {
        console.log(err);
    });
});

function getProductArchive() {
    loader();
    $.ajax({
        type: 'get',
        url: Product.url.archive
    }).done(res => {
        swal.close();
        console.clear();
        console.log(res);
        if(res.products.next_page_url == null) {
            $('#view_more_product_archive_btn').remove();
        }
        for(var x in res.products.data) {
            $('#product_archive_container').append(Product.productArchive(res.products.data[x]));
        }
    }).fail(err => {
        console.log(err);
    });
}

function archiveProduct(id) {
    swal({
        title: 'Are you sure?',
        text: 'The selected product will be moved to archive.',
        dangerMode: true,
        buttons: true,
    }).then(willArchive => {
        if(willArchive) {
            $.ajax({
                type: 'post',
                url: `${url}/admin/product/archive/id=${id}`,
                data: {
                    _token: $('input[name=_token]').val()
                }
            }).done(res => {
                $(`#product_${id}`).remove();
                success("Product moved to archive");
                console.log(res);
            }).fail(err => {
                console.log(err);
            })
        }
    });
}

function removeArchive(id) {
    swal({
        title: 'Are you sure?',
        text: 'The selected product will be restore.',
        dangerMode: true,
        buttons: true,
    }).then(willRemove => {
        if(willRemove) {
            $.ajax({
                type: 'post',
                url: `${url}/admin/product/remove_archive/id=${id}`,
                data: {
                    _token: $('input[name=_token]').val()
                }
            }).done(res => {
                $(`#product_${id}`).remove();
                success("Product removed from archive");
                console.log(res);
            }).fail(err => {
                console.log(err);
            });
        }
    });
}

function acceptRequest(id) {
    swal({
        title: 'Are you sure?',
        text: 'The selected product will be accepted.',
        dangerMode: true,
        buttons: true,
    }).then(willAccept => {
        if(willAccept) {
            $.ajax({
                type: 'post',
                url: `${url}/admin/product/accept/id=${id}`,
                data: {
                    _token: $('input[name=_token]').val()
                }
            }).done(res => {
                $(`#product_${id}`).remove();
                success("Product request accepted");
            }).fail(err => {
                console.log(err);
            });
        }
    });
}

function declineRequest(id) {
    swal({
        title: 'Are you sure?',
        text: 'The selected product will be declined.',
        dangerMode: true,
        buttons: true,
    }).then(willDecline => {
        if(willDecline) {
            $.ajax({
                type: 'delete',
                url: `${url}/admin/product/decline/id=${id}`,
                data: {
                    _token: $('input[name=_token]').val()
                }
            }).done(res => {
                $(`#product_${id}`).remove();
                success("Product request declined");
            }).fail(err => {
                console.log(err);
            });
        }
    });
}

function findProduct(id) {
    $.ajax({
        type: 'get',
        url: `${url}/admin/product/find/id=${id}`
    }).done(res => {
        console.clear();
        console.log(res);
        Product.id = res.product.id;
        $('#product_name').val(res.product.name);
        $('#product_price').val(res.product.price);
        $('#product_discount').val(res.product.discount);
        $('#product_delivery_fee').val(res.product.delivery_fee);
        $('#product_srp').val(res.product.srp);
        $('#product_warranty').val(res.product.warranty);
        $('#product_quantity').val(res.product.quantity);
        $('#product_description').val(res.product.description);
    }).fail(err => {
        console.log(err);
    });
}

$('#edit_product_list_form').on('submit', function(e) {
    e.preventDefault();
    let productData = new FormData(this);
    $.ajax({
        type: 'post',
        url: `${url}/admin/product/update/id=${Product.id}`,
        data: productData,
        cache: false,
        contentType: false,
        processData: false
    }).done(res => {
        console.log(res);
        $('#edit_product_list_modal').modal('hide');
        success("Product Updated!");
        $(`#product_${Product.id} td`).remove();
        $(`#product_${Product.id}`).append(Product.productRow(res.product, res.store.name));
        console.log(res);
    }).fail(err => {
        console.log(err);
    });
}); 