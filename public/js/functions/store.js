const UserStore = {
    details: () => {
        $.ajax({
            type:'get',
            url:`${url}/user/api/store/json`
        }).done(res => {
            $('.loader-div').remove();
            let store1 = new Store(
                res.store.id,
                res.store.name,
                res.store.email,
                res.store.contact,
                res.store.address,
                res.store.status,
                res.store.description,
                res.store.image
            );
            $('#store_details_container').prepend(store1.UserStore.details()).hide().fadeIn(500);
            $('#store_name').val(res.store.name);
            $('#store_email').val(res.store.email);
            $('#store_contact').val(res.store.contact);
            $('#store_address').val(res.store.address);
            $('#store_description').val(res.store.description);
        }).fail(err => {
            console.log(err);
        });
    },
    product: {
        all: (productUrl) => {
            loader();
            $.ajax({
                type:'get',
                url:productUrl
            }).done(res => {
                swal.close();
                $('.store_product').remove();
                checkProductURL(res.products.next_page_url, res.products.prev_page_url);
                productURL.next.url = res.products.next_page_url;
                productURL.prev.url = res.products.prev_page_url;
                for(var x in res.products.data) {
                    let product1 = new Product(
                        res.products.data[x].id,
                        res.products.data[x].name,
                        res.products.data[x].price,
                        res.products.data[x].srp,
                        res.products.data[x].quantity,
                        res.products.data[x].warranty,
                        res.products.data[x].delivery_fee,
                        res.products.data[x].availability
                    );
                    $('#store_products_container').append(product1.UserStoreProduct.productRow).hide().fadeIn(200);
                }
            }).fail(err => {
                console.log(err);
            });
        },
        prev: () => {
            if (productURL.prev.active == false) { return 0 }
            UserStore.product.all(productURL.prev.url);
        },
        next: () => {
            if (productURL.next.active == false) { return 0 }
            UserStore.product.all(productURL.next.url);
        }
    },
    update: (data) => {
        $.ajax({
            type: 'post',
            url: `${url}/store/api/update/my_store`,
            data: data,
            cache: false,
            contentType: false,
            processData: false
        }).done(res => {
            $('#edit_store_modal').modal('hide')
            $('.store_details').remove()
            UserStore.details();
        }).fail(err => {
            $('.alert').remove();
            storeUpdateErrors(err);
            console.log(err);
        })
    },
    searchProduct: (data) => {
        loader();
        $.ajax({
            type: 'get',
            url: `${url}/user/api/store/products/search/${data}`
        }).done(res => {
            $('#search').val("");
            swal.close();
            console.log(res);
            $('.searched_product').remove();
            if(res.products.total > 5) { $('#load_more_search_product_container').show(); }
            if(res.products.data.length == 0) { swal("No results found"); }
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
                );
                $('#search_products_container').append(product1.UserStoreProduct.searchProductRow)
            }
        }).fail(err => {
            swal.close();
            console.log(err);
        })
    },
    storeOrders: () => {
        loader();
        $.ajax({
            type: 'get',
            url: `${url}/user/api/store/products/orders/json`
        }).done(res => {
            swal.close();
            console.log(res);
            for(var x in res.orders.data) {
                let order1 = new StoreProduct(
                    res.orders.data[x].product.id,
                    res.orders.data[x].product.name,
                    res.orders.data[x].product.price,
                    res.orders.data[x].product.images[0].image,
                    res.orders.data[x].product.code,
                );
                $('#store_orders_container').append(order1.orders(
                    res.orders.data[x].quantity, 
                    res.orders.data[x].total_price, 
                    res.orders.data[x].status, 
                    res.orders.data[x].tracking_number,
                    res.orders.data[x].payment_options,
                    res.orders.data[x].id)).hide().fadeIn(500);
            }
        }).fail(err => {
            console.log(err);
        })
    }
}

let productURL = {
    current: {
        url :`${url}/user/api/store/products/json`,
        active: true
    },
    next: {
        url: '',
        active: true
    },
    prev: {
        url: '',
        active: true
    }
}

$('#update_store_form').on('submit', function(e) {
    e.preventDefault();
    let editStoreData = new FormData(this);
    UserStore.update(editStoreData);
});

$('#search_store_product_form').on('submit', function(e) {
    e.preventDefault();
    let searchData = $('#search').val();
    UserStore.searchProduct(searchData);
});

$('#change_store_image_form').on('submit', function(e) {
    e.preventDefault();
    let imageData = new FormData(this);
    loader();
    $.ajax({
        type: 'post',
        url: `${url}/store/api/update/store_image`,
        data: imageData,
        cache: false,
        contentType: false,
        processData: false
    }).done(res => {
        swal.close();
        $('#edit_store_image_modal').modal('hide');
        $('.store_image').remove();
        $('#store_image_container').append(`
            <img src="/storage/images/store_images/${res.store.id}/${res.store.image}" alt="..." class="store_image">
        `);
        console.log(res);
    }).fail(err => {
        console.log(err);
    })
});

function checkOrder(id) {
    $('#check_order_modal').modal('show');
    $.ajax({
        type: 'get',
        url: `${url}/order/api/find/id=${id}`
    }).done(res => {
        console.log(res);
    }).fail(err => {
        console.log(err);
    });
}
