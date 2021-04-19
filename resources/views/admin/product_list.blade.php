@extends('layouts.admin')

@section('content')
    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Product list</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Search Product</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <table class="table table-hover text-center table-bordered">
                    <thead> 
                        <tr> 
                            <th class="text-center">Product ID</th> 
                            <th class="text-center">Name</th> 
                            <th class="text-center">Price</th> 
                            <th class="text-center">SRP</th> 
                            <th class="text-center">Discount</th> 
                            <th class="text-center">Quantity</th> 
                            <th class="text-center">Delivery Fee</th> 
                            <th class="text-center">Store Name</th> 
                            <th class="text-center">Options</th> 
                        </tr> 
                    </thead> 
                    <tbody id="product_list_container"> 
                        <!-- ============ APPEND HERE ============= -->
                    </tbody> 
                </table>
                <button class="btn btn-default form-control" id="view_more_product_list_btn" onclick='getProductList()'>View more</button>
            </div>

            <div role="tabpanel" class="tab-pane" id="profile">
                <form id="search_product_list_form" autocomplete="off">
                    <div class="form-group">
                        <label class="control-label">Search product</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" id="search_product_list_input" placeholder="Enter product name or code">
                        </div>
                    </div>
                </form>
                <table class="table table-hover text-center table-bordered">
                    <thead> 
                        <tr> 
                            <th class="text-center">Product ID</th> 
                            <th class="text-center">Name</th> 
                            <th class="text-center">Price</th> 
                            <th class="text-center">SRP</th> 
                            <th class="text-center">Discount</th> 
                            <th class="text-center">Quantity</th> 
                            <th class="text-center">Delivery Fee</th> 
                            <th class="text-center">Store Name</th> 
                            <th class="text-center">Options</th> 
                        </tr> 
                    </thead> 
                    <tbody id="searched_product_list_container"> 
                        <!-- ============ APPEND HERE ============= -->
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="edit_product_list_modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="edit_product_list_form" autocomplete="off">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Product</h4>
                    </div>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/admin/Product.js"></script>
    <script>
        $(document).ready(() => { getProductList() })
    </script>
@endsection