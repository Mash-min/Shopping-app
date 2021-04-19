const UserCart = {
    all: () => {
        loader();
        $.ajax({
            type: 'get',
            url: `${url}/cart/api/json`
        }).done(res => {
            swal.close();
            console.log(res);
            for(var x in res.cart) {
                let cart1 = new Cart(
                    res.cart[x].id,
                    res.cart[x].product.id,
                    res.cart[x].product.name,
                    res.cart[x].product.price,
                    res.cart[x].product.images[0].image
                )
                $('#my_carts_container').prepend(cart1.cartTable())
            }
        }).fail(err => {
            console.log(err);
        });
    },
    add: (id) => {
        $.ajax({
            type: 'post',
            url: `${url}/cart/api/create`,
            data: {
                product_id: id,
                _token: $('input[name=_token]').val()
            }
        }).done(res => {
            success("Item added to cart");
            console.log(res);
        }).fail(err => {
            swal(err.responseJSON.message);
            console.log(err);
        })
    },
    remove: (id) => {
        swal({
            title: 'Are you sure?',
            text: 'The selected item will be removed from cart.',
            dangerMode: true,
            buttons: true,
        }).then(willRemove => {
            if(willRemove) {
                $.ajax({
                    type: 'delete',
                    url: `${url}/cart/api/delete/id=${id}`,
                    data: {
                        _token: $('input[name=_token]').val()
                    }
                }).done(() => {
                    success("Product removed");
                    $(`#cart-${id}`).remove();
                }).fail(err => {
                    console.log(err);
                });
            }
        });
    }
}