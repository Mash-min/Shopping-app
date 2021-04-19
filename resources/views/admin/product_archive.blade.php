@extends('layouts.admin')

@section('content')
    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Product Archive</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Search Archive</a></li>
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
                    <tbody id="product_archive_container"> 
                        <!-- ============ APPEND HERE ============= -->
                    </tbody> 
                </table>
                <button class="btn btn-primary form-control" id="view_more_product_archive_btn" onclick=''>View more</button>
            </div>

            <div role="tabpanel" class="tab-pane" id="profile">
                <form id="search_product_archive_form" autocomplete="off">
                    <div class="form-group">
                        <label class="control-label">Search Archive</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" id="search_product_archive_input" placeholder="Enter product name or code">
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
                    <tbody id="searched_product_archive_container"> 
                        <!-- ============ APPEND HERE ============= -->
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/admin/Product.js"></script>
    <script>
        $(document).ready(() => { getProductArchive() });
    </script>
@endsection