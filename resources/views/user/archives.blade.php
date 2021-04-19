@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h2>Product archives</h2></div>
        <table class="table table-bordered text-center">
            <thead> 
                <tr> 
                    <th class="text-center">Name</th> 
                    <th class="text-center">Price</th> 
                    <th class="text-center">SRP</th> 
                    <th class="text-center">Discount</th> 
                    <th class="text-center">Quantity</th> 
                    <th class="text-center">Warranty</th> 
                    <th class="text-center">Delivery Fee</th> 
                    <th class="text-center">Options</th> 
                </tr>  
            </thead> 
            <tbody id="product_archives_container"> 
                <!-- APPEND HERE -->
            </tbody> 
        </table>
    </div>
    <nav aria-label="...">
        <ul class="pager">
            <li class="disabled"><a href="#">Previous</a></li>
            <li class="disabled"><a href="#">Next</a></li>
        </ul>
    </nav>
@endsection

@section('scripts')
    <script src="/js/class/Product.js"></script>
    <script src="/js/functions/product.js"></script>
    <script>
        $(document).ready(function() {
            Archive.all();
        });
    </script>
@endsection