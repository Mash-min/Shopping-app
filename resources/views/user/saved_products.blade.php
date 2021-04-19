@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Saved Products</h2>
        </div>
        <div class="panel-body">
            <div class="row" id="saved_products_container">
                <!-- APPEND HERE -->
            </div> 
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/class/Product.js"></script>
    <script src="/js/functions/product.js"></script>
    <script>
        $(document).ready(function() {
            Products.savedProducts();
        });
    </script>
@endsection