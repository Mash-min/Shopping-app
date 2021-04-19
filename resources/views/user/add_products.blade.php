@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Add Product</h3>
        </div>
        <div class="panel-body row">
            <form autocomplete="off" id="create_product_form">
                {{ @csrf_field() }}
                <div class="form-group col-md-6 form-name">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter product name">
                </div>
                <div class="form-group col-md-6 form-price">
                    <label for="price">Price:</label>
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="number" name="price" id="price" class="form-control" placeholder="Enter product price">
                    </div>
                </div>
                <div class="form-group col-md-6 form-discount">
                    <label for="discount">Discount:</label>
                    <div class="input-group">
                        <span class="input-group-addon">%</span>
                        <input type="number" name="discount" id="discount" class="form-control" placeholder="Enter product discout">
                    </div>
                </div>
                <div class="form-group col-md-6 form-srp">
                    <label for="srp">SRP:</label>
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="number" name="srp" id="srp" class="form-control" placeholder="Enter product SRP">
                    </div>
                </div>
                <div class="form-group col-md-4 form-warranty">
                    <label for="warranty">Days of Warranty:</label>
                    <input type="number" name="warranty" id="warranty" class="form-control" placeholder="Enter days of warranty">
                </div>
                <div class="form-group col-md-4 form-quantity">
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter product quantity">
                </div>
                <div class="form-group col-md-4 form-delivery-fee">
                    <label for="delivery_fee">Delivery Fee:</label>
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="number" name="delivery_fee" id="delivery_fee" class="form-control" placeholder="Enter delivery fee">
                    </div>
                </div>
                <div class="form-group col-md-12 form-image">
                    <label for="image">Product images:</label>
                    <input type="file" name="image[]" multiple id="image" class="form-control" placeholder="Add product image">
                </div>
                <div class="form-group col-md-12 form-description">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Enter product description"></textarea>
                </div>
            </form>
            <div class="form-group col-md-6 form-tags">
                <label for="tags">Product tags:</label>
                <input name="tags" data-role="tagsinput" placeholder="Add product tags">
            </div>
            <div class="form-group col-md-6 form-category">
                <label for="category">Product Category</label>
                <select class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group col-md-4 col-md-offset-8">
                <button class="btn btn-default form-control" type="button" onclick="$('#create_product_form').submit()">
                    Save product <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </div>     
@endsection

@section('scripts')
    <link rel="stylesheet" href="/css/bootstrap-tagsinput.css">
    <script src="/js/bootstrap-tagsinput.js"></script>
    <script src="/js/class/Product.js"></script>
    <script src="/js/functions/product.js"></script>
    <script src="/js/functions/errors.js"></script>
@endsection