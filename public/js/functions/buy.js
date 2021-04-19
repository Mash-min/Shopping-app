let order = [];
function addToOrder(cart_id, product_id) {
    let quantity = $(`#quantity_${cart_id}`).val();
    order.push({
        cart: {
            id: cart_id,
            product_id: product_id,
            quantity: quantity
        }
    })
    $(`#quantity_${cart_id}`).addClass('disable');
    $(`.btn_${cart_id}`).remove();
    $(`#add_to_order_${cart_id}`).append(`
        <button class="btn btn-default btn_${cart_id}" onclick="removeToOrder('${cart_id}')">
            <i class="fa fa-times"></i>
        </button>
    `);
}

function removeToOrder(cart_id) {
    $(`.btn_${cart_id}`).remove();
    $(`#add_to_order_${cart_id}`).append(`
        <button class="btn btn-default btn_${cart_id}" onclick="addToOrder('${cart_id}')">
            <i class="fa fa-check"></i>
        </button>
    `);
    for(var x in order) {
        order.map(() => {
            if(order[x].cart.id === cart_id) {
                delete order[x];
            }
        });
    }
}

function buy() {
    if(order.length == 0) {
        swal("Please select a product");
    }else {
        loader();
        $.ajax({
            type: 'post',
            url: `${url}/order/api/create`,
            data: {
                _token: $('input[name=_token]').val(),
                payment_option: $('#payment_options').val(),
                order
            }
        }).done(res => {
            success("Products succesfully ordered");
            for(var x in order) {
                $(`#cart-${order[x].cart.id}`).remove();
            }
            console.log(res);
            order = {};
        }).fail(err => {
            console.log(err);
            swal(err.responseJSON.message);
        });
    }
}