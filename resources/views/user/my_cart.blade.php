@extends('layouts.app')

@section('content')
    {{ @csrf_field() }}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Cart</h2>
        </div>
        <table class="table table-bordered text-center">
            <thead> 
                <tr> 
                    <th class="text-center"><i class="fa fa-image"></i></th> 
                    <th class="text-center">Product name</th> 
                    <th class="text-center">Quantity</th> 
                    <th class="text-center">Price</th> 
                    <th class="text-center">Total</th>
                    <th class="text-center">Buy</th>
                    <th class="text-center">Remove</th>
                </tr> 
            </thead> 
            <tbody id="my_carts_container"> 
                <!-- APPEND HERE -->
            </tbody> 
        </table>
    </div>
    <div class="form-group">
        <label for="">Payment Options</label>
        <select class="form-control" id="payment_options">
            <option>Cash on delivery</option>
            <option>Credit card</option>
        </select>
    </div>
    <div class="cart-footer">
        <button class="btn btn-default form-control" onclick="buy()">
            Order
        </button> 
    </div>
@endsection

@section('scripts')

<script src="/js/class/Cart.js"></script>
<script src="/js/functions/carts.js"></script>
<script>
    $(document).ready(() => UserCart.all());
</script>
<script src="/js/functions/buy.js"></script>

@endsection