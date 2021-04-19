@extends('layouts.app')

@section('content')
    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#products" aria-controls="home" role="tab" data-toggle="tab">
                    Products
                </a>
            </li>
            <li role="presentation">
                <a href="#seach_product" aria-controls="profile" role="tab" data-toggle="tab">
                    Search product
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="products">
                <div class="jumbotron">
                    <h1>Products</h1>
                    <p>Choose a product to buy</p>
                </div>
                <div class="row" id="products_container">
                    <!-- ======= APPEND HERE ========= -->
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <button class="btn btn-default form-control" id="load_more_products_btn">
                            Load more
                        </button>
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="seach_product">
                <div class="jumbotron">
                    <form id="search_product_form" autocomplete="off">
                        <div class="form-group">
                            <label for="search">Search product <i class="fa fa-search"></i></label>
                            <input type="text" name="search" id="search" class="form-control" placeholder="Enter product name"> 
                        </div>
                    </form>
                </div>
                <div class="row" id="searched_products_container">
                    <!-- ======= APPEND HERE ========= -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/class/Product.js"></script>
    <script src="/js/functions/product.js"></script>
    <script>
        $(document).ready(() => { 
            Products.all(productsURL);
        });
    </script>
@endsection