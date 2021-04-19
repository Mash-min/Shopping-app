let productsURL = `${url}/product/api/products/json`;
let product = {};

function checkProductURL(nextURL, prevURL) {
    if(prevURL == null) {
        productURL.prev.active = false;
        $('#prev_btn').addClass('disabled');
    }else {
        productURL.prev.active = true;
        $('#prev_btn').removeClass('disabled');
    }

    if(nextURL == null) {
        productURL.next.active = false;
        $('#next_btn').addClass('disabled');
    }else {
        productURL.next.active = true;
        $('#next_btn').removeClass('disabled');
    }
}

const Archive = {
    add: (id) => {
        swal({
            title: 'Are you sure?',
            text: 'The selected product will be moved to archive.',
            dangerMode: true,
            buttons: true,
        }).then((willArchive) => {
            if(willArchive) {
                $.ajax({
                    type: 'post',
                    url:`${url}/product/api/archive/id=${id}`,
                    data: {
                        _token: $('input[name=_token]').val()
                    }
                }).done(() => {
                    $(`.store_product_${id}`).remove();
                    success("Product moved to archive");
                }).fail(err => {
                    console.log(err);
                });
            }
        }) 
    },
    remove: (id) => {
        swal({
            title: 'Are you sure?',
            text: 'The selected product will be removed from archive.',
            dangerMode: true,
            buttons: true,
        }).then((willRemove) => {
            if (willRemove) {
                $.ajax({
                    type: 'post',
                    url:`${url}/product/api/remove_archive/id=${id}`,
                    data: {
                        _token: $('input[name=_token]').val()
                    }
                }).done(() => {
                    $(`.store_product_${id}`).remove();
                    success("Product removed from archive");
                }).fail(err => {
                    console.log(err);
                });
            }
        });
    },
    all: () => {
        loader();
        $.ajax({
            type: 'get',
            url: `${url}/user/api/store/products/archives/json`
        }).done(res => {
            swal.close();
            console.log(res);
            for(var x in res.products.data) {
                let archive1 = new Product(
                    res.products.data[x].id,
                    res.products.data[x].name,
                    res.products.data[x].price,
                    res.products.data[x].srp,
                    res.products.data[x].discount,
                    res.products.data[x].quantity,
                    res.products.data[x].warranty,
                    res.products.data[x].delivery_fee,
                    res.products.data[x].availability
                );
                $('#product_archives_container').append(archive1.UserStoreProduct.productArchives);
            }
        }).fail(err => {
            console.log(err);
        }) 
    }
}

const Products = {
    all: (prodUrl) => {
        loader();
        $.ajax({
            type: 'get',
            url: prodUrl
        }).done(res => {
            console.log(res);
            $('.pagination li').remove();
            swal.close();
            if (res.products.next_page_url == null) { $('#load_more_products_btn').remove(); }
            productsURL = res.products.next_page_url;
            for (var x in res.products.data) {
                let product1 = new Product(
                    res.products.data[x].id,
                    res.products.data[x].name,
                    res.products.data[x].price,
                    res.products.data[x].srp,
                    res.products.data[x].discount,
                    res.products.data[x].quantity,
                    res.products.data[x].warranty,
                    res.products.data[x].delivery_fee,
                    res.products.data[x].availability,
                    res.products.data[x].images[0].image,
                    res.products.data[x].code
                );
                $('#products_container').append(product1.UserProduct.products('product'));
            }
        }).fail(err => {
            console.log(err);
        });
    },
    find: (id) => {
        $.ajax({
            type:'get',
            url:`${url}/product/api/find/id=${id}`
        }).done(res => {
            product = res.product;
            $('#product_name').val(product.name)
            $('#product_price').val(product.price)
            $('#product_discount').val(product.discount)
            $('#product_srp').val(product.srp)
            $('#product_warranty').val(product.warranty)
            $('#product_quantity').val(product.quantity)
            $('#product_delivery_fee').val(product.delivery_fee)
            $('#product_description').val(product.description)
        }).fail(err => {
            console.log(err);
        });
    },
    delete: (id) => {
        swal({
            title: 'Are you sure?',
            text: 'The selected product will be deleted permanently.',
            dangerMode: true,
            buttons: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'post',
                    url:`${url}/product/api/delete/id=${id}`,
                    data: {
                        _token: $('input[name=_token]').val()
                    }
                }).done(() => {
                    $(`.store_product_${id}`).remove();
                    success("Product deleted");
                }).fail(err => {
                    console.log(err);
                });
            }
        });
    },
    details: (id) => {
        $.ajax({
            type: 'get',
            url: `${url}/product/api/find/${id}`
        }).done(res => {
            // console.log(res);
            $('.loader-div').remove();
            $('.product_image_container').prepend(`
                <a href="/storage/images/product_images/${res.product.id}/${res.images[0].image}" data-fancybox="gallery" data-caption="${res.product.name}">
                    <img src="/storage/images/product_images/${res.product.id}/${res.images[0].image}" alt="">
                </a>
            `);
            for(var x = 1; x < res.images.length; x++) {
                $('.other_product_images').append(`
                    <a href="/storage/images/product_images/${res.product.id}/${res.images[x].image}" data-fancybox="gallery" data-caption="${res.product.name}">
                        <img src="/storage/images/product_images/${res.product.id}/${res.images[x].image}" alt="">
                    </a>
                `);
            }
            for(var x in res.tags) {
                $('.tag-container').append(`
                    <span class="tags-span badge"><a href="#">${res.tags[x].data}</a></span>
                `);
            }
        }).fail(err => {
            console.log(err);
        })
    },
    update: (data) => {
        $.ajax({
            type:'post',
            url:`${url}/product/api/update/id=${product.id}`,
            data: data,
            contentType: false,
            cache: false,
            processData: false
        }).done(res => {
            console.log(res);
            $('#edit_product_modal').modal('hide')
            $(`.store_product_${res.product.id} td`).remove();
            success("Product updated");
            let updatedProduct = new Product(
                res.product.id,
                res.product.name,
                res.product.price,
                res.product.srp,
                res.product.discount,
                res.product.quantity,
                res.product.warranty,
                res.product.delivery_fee,
                res.product.availability
            )
            $(`.store_product_${res.product.id}`).append(updatedProduct.UserStoreProduct.productTableData);
        }).fail(err => {
            console.log(err)
        })
    },
    save: (id) => {
        $.ajax({
            type: 'post',
            url: `${url}/saved_product/api/create`,
            data: {
                _token: $('input[name=_token]').val(),
                product_id: id
            }
        }).done(res => {
            success("Product saved");
            console.log(res);
        }).fail(err => {
            swal(err.responseJSON.message);
            console.log(err);
        });
    },
    unsave: (id) => {
        swal({
            title: 'Are you sure?',
            text: 'Product removed',
            dangerMode: true,
            buttons: true,
        }).then(willUnsave => {
            if(willUnsave) {
                $.ajax({
                    type: 'delete',
                    url: `${url}/saved_product/api/delete/id=${id}`,
                    data: {
                        _token: $('input[name=_token]').val()
                    }
                }).done(res => {
                    success("Product Removed");
                    $(`#saved_product_${id}`).remove();
                    console.log(res);
                }).fail(err => {
                    swal(err.responseJSON.message);
                    console.log(err);
                });
            }
        })
    },
    savedProducts: () => {
        $.ajax({
            type: 'get',
            url: `${url}/saved_product/api/products/json`
        }).done(res => {
            console.log(res);
            for(var x in res.products.data) {
                let savedProduct1 = new Product(
                    res.products.data[x].product.id,
                    res.products.data[x].product.name,
                    res.products.data[x].product.price,
                    res.products.data[x].product.srp,
                    res.products.data[x].product.discount,
                    res.products.data[x].product.quantity,
                    res.products.data[x].product.warranty,
                    res.products.data[x].product.delivery_fee,
                    res.products.data[x].product.availability,
                    res.products.data[x].product.images[0].image,
                    res.products.data[x].product.code
                );
                $('#saved_products_container').prepend(savedProduct1.UserProduct.savedProduct(res.products.data[x].id)).hide().fadeIn(500);
            }
        }).fail(err => {
            console.log(err);
        });
    }
}

$('#search_product_form').on('submit', function(e) {
    e.preventDefault();
    loader();
    let data = $('#search').val();
    $.ajax({
        type: 'get',
        url: `${url}/product/api/search/${data}`
    }).done(res => {
        swal.close();
        console.log(res);
        $('.searched_product').remove();
        if(res.products.data.length == 0) { swal("No result found"); }
        for(var x in res.products.data) {
            let product1 = new Product(
                res.products.data[x].id,
                res.products.data[x].name,
                res.products.data[x].price,
                res.products.data[x].srp,
                res.products.data[x].discount,
                res.products.data[x].quantity,
                res.products.data[x].warranty,
                res.products.data[x].delivery_fee,
                res.products.data[x].availability,
                res.products.data[x].images[0].image,
                res.products.data[x].code,
            );
            $('#searched_products_container').prepend(product1.UserProduct.products('searched_product'))
        }
    }).fail(err => {
        console.log(err);
    });
});

$('#load_more_products_btn').click(() => { 
    Products.all(productsURL) 
});

$('#create_product_form').on('submit', function(e) {
    e.preventDefault();
    let productTags = $('input[name=tags]').tagsinput('items');
    let catgeroyTags = $('input[name=categories]').tagsinput('items');
    let productData = new FormData(this);
    loader();
    $.ajax({
        type:'post',
        url:`${url}/product/api/create`,
        data: productData,
        cache: false,
        processData: false,
        contentType: false
    }).done(res => {
        console.log(res);
        addProductTags(res.product.id, productTags);
        success("Product added.");
        swal.close();
    }).fail(err => {
        console.log(err);
        swal.close();
        $('.product_error_message').remove();
        productValidationErrors(err);
    })
});

function addProductTags(productId, data) {
    $.ajax({
        type: 'post',
        url: `${url}/tags/api/create`,
        data: {
            tags: data,
            product_id: productId,
            _token: $('input[name=_token]').val()
        }
    }).done(res => {
        console.log(res);
    }).fail(err => {
        console.log(err);
    });
}

$('#update_product_form').on('submit', function(e) {
    e.preventDefault();
    let updateData = new FormData(this);
    loader();
    Products.update(updateData);
})





