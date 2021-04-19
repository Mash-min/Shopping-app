@extends('layouts.app')

@section('content')
    {{ @csrf_field() }}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Store Orders</h2>
        </div>
        <table class="table table-bordered text-center">
            <thead> 
                <tr> 
                    <th class="text-center">Tracking number</th> 
                    <th class="text-center">Product name</th> 
                    <th class="text-center">Price</th> 
                    <th class="text-center">Quantity</th> 
                    <th class="text-center">Total price</th> 
                    <th class="text-center">Payment type</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Options</th>
                </tr> 
            </thead> 
            <tbody id="store_orders_container"> 
                <!-- append here -->
            </tbody> 
        </table>
    </div>
    <div class="modal fade" id="check_order_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/class/Store.js"></script>
    <script src="/js/functions/store.js"></script>
    <script>
        $(document).ready(() => {
            UserStore.storeOrders();
        })
    </script>
@endsection