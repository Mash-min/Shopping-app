@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="thumbnail">
                <div id="store_image_container">
                    @if($store->image != 'none')
                        <img src="/storage/images/store_images/{{$store->id}}/{{$store->image}}" alt="..." class="store_image">
                    @else 
                        <img src="/images/avatar.jpg" alt="..." class="store_image">
                    @endif
                </div>
                <div class="caption">
                    <p>
                        <button class="btn btn-default form-control" data-toggle="modal" data-target="#edit_store_image_modal">
                            Change Image <i class="fa fa-image"></i>
                        </button> 
                    </p>
                </div>
            </div>
        </div>
    <div>
    </div>
        <div class="col-md-8" id="store_details_container">
            <div class="loader-div"></div>
            <div class="loader-div loader-div-item"></div>
            <div class="loader-div loader-div-item"></div>
            <!-- ========== APPEND HERE ============ -->
        </div>
    </div>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#product_list" aria-controls="home" role="tab" data-toggle="tab">Product list</a>
        </li>
        <li role="presentation">
            <a href="#search_product" aria-controls="profile" role="tab" data-toggle="tab">Search product</a>
        </li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="product_list">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Products list</h2>
                </div>
                <table class="table table-hover text-center table-bordered">
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
                    <tbody id="store_products_container"> 
                        <!-- ============ APPEND HERE ============= -->
                    </tbody> 
                </table>
            </div>
            <nav aria-label="...">
                <ul class="pager">
                    <li id="prev_btn"><a onclick="UserStore.product.prev()">Previous</a></li>
                    <li id="next_btn"><a onclick="UserStore.product.next()">Next</a></li>
                </ul>
            </nav>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="search_product">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Search product</h2>
                    <div class="form-group">
                        <form autocomplete="off" id="search_store_product_form">
                            <label for="search">Search product</label>
                            <input type="text" name="search" id="search" class="form-control" placeholder="Enter product name">
                        </form>
                    </div>
                </div>
                <table class="table table-hover text-center table-bordered">
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
                    <tbody id="search_products_container"> 
                        <!-- ============ APPEND HERE ============= -->
                    </tbody> 
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_store_image_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Change Store Image</h4>
                </div>
                <form id="change_store_image_form">
                    {{ @csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Store Image</label>
                            <input type="file" name="image" class="form-control">
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
    
    <div class="modal fade" id="edit_store_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="update_store_form" autocomplete="off">
                    {{ @csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Update store</h4>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group name-form col-md-12">
                            <label for="store_name">Name:</label>
                            <input type="text" name="name" id="store_name" class="form-control" placeholder="Enter store name">
                        </div>
                        <div class="form-group email-form col-md-12">
                            <label for="store_email">Email:</label>
                            <input type="email" name="email" id="store_email" class="form-control" placeholder="Enter store email">
                        </div>
                        <div class="form-group contact-form col-md-12">
                            <label for="store_contact">Contact:</label>
                            <input type="number" name="contact" id="store_contact" class="form-control" placeholder="Enter store contact">
                        </div>
                        <div class="form-group address-form col-md-12">
                            <label for="store_address">Address:</label>
                            <input type="text" name="address" id="store_address" class="form-control" placeholder="Enter store address">
                        </div>
                        <div class="form-group description-form col-md-12">
                            <label for="store_description">Decription:</label>
                            <textarea name="description" id="store_description" cols="30" rows="10" class="form-control" placeholder="Enter store description"></textarea>
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

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="edit_product_modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Product</h4>
                </div>
                <form id="update_product_form" autocomplete="off">
                    <div class="modal-body">
                            {{ @csrf_field() }}
                            <div class="form-group name-form col-md-6">
                                <label for="product_name">Name:</label>
                                <input type="text" name="name" id="product_name" class="form-control" placeholder="Enter your product name">
                            </div>
                            <div class="form-group price-form col-md-6">
                                <label for="product_price">Price:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="number" name="price" id="product_price" class="form-control" placeholder="Enter your product price">
                                    <span class="input-group-addon">.00</span>
                                </div>
                            </div>
                            <div class="form-group discount-form col-md-4">
                                <label for="product_discount">Discount:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">%</span>
                                    <input type="number" name="discount" id="product_discount" class="form-control" placeholder="Enter your product discount">
                                    <span class="input-group-addon">.00</span>
                                </div>
                            </div>
                            <div class="form-group delivery-fee-form col-md-4">
                                <label for="product_delivery_fee">Delivery fee:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="number" name="delivery_fee" id="product_delivery_fee" class="form-control" placeholder="Enter product delivery fee">
                                    <span class="input-group-addon">.00</span>
                                </div>
                            </div>
                            <div class="form-group srp-form">
                                <label for="product_srp col-md-4">SRP:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="number" name="srp" id="product_srp" class="form-control" placeholder="Enter product srp">
                                    <span class="input-group-addon">.00</span>
                                </div>
                            </div>
                            <div class="form-group warranty-form col-md-6">
                                <label for="product_warranty">Warranty:</label>
                                <div class="input-group">
                                    <input type="number" name="warranty" id="product_warranty" class="form-control" placeholder="Enter product days of warranty">
                                    <span class="input-group-addon">Days</span>
                                </div>
                            </div>
                            <div class="form-group quantity-form col-md-6">
                                <label for="product_quantity">Quantity:</label>
                                <div class="input-group">
                                    <input type="number" name="quantity" id="product_quantity" class="form-control" placeholder="Enter product quantity">
                                    <span class="input-group-addon">pcs</span>
                                </div>
                            </div>
                            <div class="form-group image-form">
                                <label for="product_image">Product Images</label>
                                <input type="file" name="image[]" multiple id="product_image" class="form-control" placeholder="Add product image">
                            </div>
                            <div class="form-group description-form">
                                <label for="product_description">Product Description:</label>
                                <textarea name="description" id="product_description" cols="30" rows="10" placeholder="Enter your store description" class="form-control"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-default" onclick="$('#update_product_form').submit()">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="/css/bootstrap-tagsinput.css">
    <script src="/js/bootstrap-tagsinput.js"></script>
    <script src="/js/class/Store.js"></script>
    <script src="/js/class/Product.js"></script>
    <script src="/js/functions/store.js"></script>
    <script src="/js/functions/product.js"></script>
    <script src="/js/functions/errors.js"></script>
    <script>
        $(document).ready(() => {
            UserStore.details();
            UserStore.product.all(productURL.current.url);
        });
    </script>
@endsection