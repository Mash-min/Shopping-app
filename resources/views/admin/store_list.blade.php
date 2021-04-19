@extends('layouts.admin')

@section('content')
    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Store list</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Search Store</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <table class="table table-hover text-center table-bordered">
                    <thead> 
                        <tr> 
                            <th class="text-center">Name</th> 
                            <th class="text-center">Email</th> 
                            <th class="text-center">Address</th> 
                            <th class="text-center">Contact</th> 
                            <th class="text-center"># of products</th> 
                            <th class="text-center">Options</th> 
                        </tr> 
                    </thead> 
                    <tbody id="store_list_container"> 
                        <!-- ============ APPEND HERE ============= -->
                    </tbody> 
                </table>
                <button class="btn btn-default form-control" id="view_more_store_list_btn">View more</button>
            </div>

            <div role="tabpanel" class="tab-pane" id="profile">
                <form id="search_store_list_form" autocomplete="off">
                    <div class="form-group">
                        <label class="control-label">Search store</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" id="search_store_list_input" placeholder="Enter store name">
                        </div>
                    </div>
                </form>
                <table class="table table-hover text-center table-bordered">
                    <thead> 
                        <tr> 
                            <th class="text-center">Name</th> 
                            <th class="text-center">Email</th> 
                            <th class="text-center">Address</th> 
                            <th class="text-center">Contact</th> 
                            <th class="text-center"># of products</th> 
                            <th class="text-center">Options</th> 
                        </tr> 
                    </thead> 
                    <tbody id="searched_store_list_container"> 
                        <!-- ============ APPEND HERE ============= -->
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/admin/Store.js"></script>
    <script>
        $(document).ready(() => { getStoreList() });
    </script>
@endsection