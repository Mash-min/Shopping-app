@extends('layouts.app')

@section('content')
    {{ @csrf_field() }}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Orders</h2>
        </div>
        <table class="table table-bordered text-center">
            <thead> 
                <tr> 
                    <th class="text-center"><i class="fa fa-image"></i></th> 
                    <th class="text-center">Product name</th> 
                    <th class="text-center">Price</th> 
                    <th class="text-center">Quantity</th> 
                    <th class="text-center">Total price</th> 
                    <th class="text-center">Status</th>
                    <th class="text-center">-</th>
                </tr> 
            </thead> 
            <tbody id="orders_container"> 
                <!-- append here -->
            </tbody> 
        </table>
    </div>
    @if($orders > 5)
        <div id="view_more_order_container">
            <button class="btn btn-default form-control" id="view_more_orders_btn">
                Show more
            </button>
        </div>
    @endif
@endsection

@section('scripts')
    <script src="/js/class/Order.js"></script>
    <script>

        $(document).ready(function() {
            getMyOrders();
        });

        function deleteOrder(id) {
            swal({
                title: 'Are you sure?',
                text: 'The selected order will be canceled',
                dangerMode: true,
                buttons: true,
            }).then(willRemove => {
                if(willRemove) {
                    $.ajax({
                        type: 'delete',
                        url: `${url}/order/api/delete/id=${id}`,
                        data: {
                            _token: $('input[name=_token]').val()
                        }
                    }).done(() => {
                        $(`#order-${id}`).remove();
                        success("Order canceled");
                    }).fail(err => {
                        console.log(err);
                    });
                }
            })
        }

        let orderUrl = `${url}/order/api/json`;
        function getMyOrders() {
            loader();
            $.ajax({
                type: 'get',
                url: orderUrl
            }).done(res => {
                swal.close();
                console.log(res);
                orderUrl = res.orders.next_page_url;
                if(res.orders.next_page_url == null) {
                    $('#view_more_order_container').remove();
                }
                for(var x in res.orders.data) {
                    let order1 = new Order(
                        res.orders.data[x].id,
                        res.orders.data[x].cart_id,
                        res.orders.data[x].product_id,
                        res.orders.data[x].quantity,
                        res.orders.data[x].total_price,
                        res.orders.data[x].status
                    );
                    $('#orders_container').append(order1.orderProduct(
                        res.orders.data[x].product.name,
                        res.orders.data[x].product.price,
                        res.orders.data[x].product.images[0].image
                    ));
                }
            }).fail(err => {
                console.log(err);
            });
        }

        $('#view_more_orders_btn').click(() => {
            getMyOrders();
        })
    </script>
@endsection