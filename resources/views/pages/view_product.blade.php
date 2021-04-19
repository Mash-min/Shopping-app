@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4" style="margin-bottom:10px;"> 
            <div class="product_image_container">
                <div class="loader-div"><p></p></div>
            </div>
            <div class="other_product_images">

            </div>
        </div>
    <div>
    </div>
        <div class="col-md-8" id="product_details_container">
            <ul class="list-group product_details">
                <li class="list-group-item"><h2>{{ $product->name }}</h2></li>
                <li class="list-group-item cart_btn_container">
                    <a class="btn btn-default form-control" onclick="Products.save('{{ $product->id }}')">
                        Save product
                    </a> 
                </li>
                <li class="list-group-item tag-container"><b>Tags:</b></li>
                <li class="list-group-item"><b>Price:</b> {{ $product->price }}</li>
                <li class="list-group-item"><b>Warranty:</b> {{ $product->warranty }} day/s return</li>
                <li class="list-group-item"><b>Delivery Fee:</b> {{ $product->delivery_fee }}.00</li>
                <li class="list-group-item"><b>Description:</b> {{ $product->description }}</li>
                <li class="list-group-item cart_btn_container">
                    <a class="btn btn-default form-control" onclick="UserCart.add('{{ $product->id }}')">
                        Add to cart
                    </a> 
                </li>
            </ul>
        </div>
    </div>

    <div class="row tab-row">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#related_products" aria-controls="home" role="tab" data-toggle="tab">Related Product</a>
            </li>
            <li role="presentation">
                <a href="#reviews_panel" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a>
            </li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="related_products">
                <div class="panel panel-default" style="margin-top: 20px;">
                    <div class="panel-heading">
                        <h4>Related products</h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 product-container">
                            <div class="thumbnail product">
                                <div class="caption product-content">
                                    <div class="product-image-container">
                                        <!-- <img src="/images/1.jpg" alt=""> -->
                                    </div>
                                    <h4 class="center">Sample Product</h4>
                                    <p>$ 1000.00</p>
                                    <p class="center">
                                        <a href="#" class="btn btn-default form-control">
                                            View product
                                        </a> 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 product-container">
                            <div class="thumbnail product">
                                <div class="caption product-content">
                                    <div class="product-image-container">
                                        <!-- <img src="/images/1.jpg" alt=""> -->
                                    </div>
                                    <h4 class="center">Sample Product</h4>
                                    <p>$ 1000.00</p>
                                    <p class="center">
                                        <a href="#" class="btn btn-default form-control">
                                            View product
                                        </a> 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 product-container">
                            <div class="thumbnail product">
                                <div class="caption product-content">
                                    <div class="product-image-container">
                                        <!-- <img src="/images/1.jpg" alt=""> -->
                                    </div>
                                    <h4 class="center">Sample Product</h4>
                                    <p>$ 1000.00</p>
                                    <p class="center">
                                        <a href="#" class="btn btn-default form-control">
                                            View product
                                        </a> 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 product-container">
                            <div class="thumbnail product">
                                <div class="caption product-content">
                                    <div class="product-image-container">
                                        <!-- <img src="/images/1.jpg" alt=""> -->
                                    </div>
                                    <h4 class="center">Sample Product</h4>
                                    <p>$ 1000.00</p>
                                    <p class="center">
                                        <a href="#" class="btn btn-default form-control">
                                            View product
                                        </a> 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="reviews_panel">
                <div class="reviews">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <form id="create_review_form" autocomplete="off">
                                <div class="form-group">
                                    {{ @csrf_field() }}
                                    <label for="review">Add Review</label>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="text" name="message" id="review" class="form-control" placeholder="Enter your review">
                                </div>
                            </form>
                        </div>
                        <div class="panel-body" id="reviews_container">
                            <!-- ============= APPEND REVIEWS HERE ============ -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="editReviewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="edit_review_form">
                            {{ @csrf_field() }}
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Edit review</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="message">Enter your review</label>
                                    <textarea name="message" id="message_inp" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-default">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
@endsection

@section('scripts')
    <script>
        $(document).ready(() => { 
            Products.details('{{ $product->code }}');
            getReviews('{{ $product->code }}');
        });
    </script>
    <script src="/js/class/Product.js"></script>
    <script src="/js/class/Review.js"></script>
    <script src="/js/functions/product.js"></script>
    <script src="/js/functions/carts.js"></script>
    <script src="/js/functions/reviews.js"></script>
@endsection