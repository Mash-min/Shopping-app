let storeId = $('#store_id').val();
let storeProductsURL = `${url}/store/api/stores/view/products/json/${storeId}`;
function getStoreProducts() {
    loader();
    $.ajax({
        type: 'get',
        url: storeProductsURL
    }).done(res => {
        $('.loader-div-item').remove();
        swal.close();
        if(res.products.next_page_url == null) {
            $('#load_more_products').remove();
        }
        for(var x in res.products.data) {
            let product1 = new StoreProduct(
                res.products.data[x].id, 
                res.products.data[x].name, 
                res.products.data[x].price, 
                res.products.data[x].images[0].image, 
                res.products.data[x].code
            );
            $('#store_products_container').append(product1.products());
        }
        storeProductsURL = res.products.next_page_url
    }).fail(err => {
        console.log(err);
    })
}

$('#load_more_products').click(() => {
    getStoreProducts(storeProductsURL);
});

const UserStore = {
    savedStores: () => {
        loader();
        $.ajax({
            type: 'get',
            url: `${url}/followed_store/api/stores/json`
        }).done(res => {
            swal.close();
            for(var x in res.stores.data) {
                let followedStore1 = new Store(
                    res.stores.data[x].store.id,
                    res.stores.data[x].store.name,
                    res.stores.data[x].store.email,
                    res.stores.data[x].store.contact,
                    res.stores.data[x].store.address,
                    res.stores.data[x].store.status,
                    res.stores.data[x].store.description,
                    res.stores.data[x].store.image,
                );
                $('#saved_stores_container').prepend(followedStore1.UserStore.savedStores(res.stores.data[x].id)).hide().fadeIn(300);
            }
        }).fail(err => {
            console.log(err);
        })
    },
    follow: (id) => {
        $.ajax({
            type: 'post',
            url: `${url}/followed_store/api/create`,
            data: {
                _token: $('input[name=_token]').val(),
                store_id: id
            }
        }).done(res => {
            $('#follow_btn').remove();
            $('#follow_store_btn_container').append(`
                <button class="btn btn-default form-control" id="unfollow_btn" onclick="UserStore.removeFollow('${res.followed_store.id}')">
                    Unfollow
                </button>
            `);
            success("Store followed");
            console.log(res);
        }).fail(err => {
            swal(err.responseJSON.message)
            console.log(err);
        }); 
    },
    removeFollow: (id) => {
        $.ajax({
            type: 'delete',
            url: `${url}/followed_store/api/delete/id=${id}`,
            data: {
                _token: $('input[name=_token]').val(),
                store_id: id
            }
        }).done(res => {
            $('#unfollow_btn').remove();
            $('#follow_store_btn_container').append(`
                <button class="btn btn-default form-control" id="follow_btn" onclick="UserStore.follow('${storeId}')">
                    Follow store
                </button>
            `);
            console.log(res);
        }).fail(err => {
            swal(err.responseJSON.message)
            console.log(err);
        }); 
    },
    unfollow: (id) => {
        swal({
            title: 'Unfollow Store?',
            text: 'The selected store will be unfollowed',
            dangerMode: true,
            buttons: true,
        }).then(willUnfollow => {
            if(willUnfollow) {
                $.ajax({
                    type: 'delete',
                    url: `${url}/followed_store/api/delete/id=${id}`,
                    data: {
                        _token: $('input[name=_token]').val()
                    }
                }).done(res => {
                    $(`.followed_store_${id}`).remove();
                }).fail(err => {
                    console.log(err);
                });
            }
        }); 
    }
}

function getStoreDetails(id) {
    $.ajax({
       type: 'get',
       url: `${url}/store/api/find/id=${id}` 
    }).done(res => {
        $('#store_details').remove();
        console.log(res);
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
        $('#store_details_container').prepend(store1.storeDetails(res.followers.length, res.products.length, res.following));
    }).fail(err => {
        console.log(err);
    })
}