@extends('layouts.admin')

@section('content')
    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Store list</a></li>
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
                    <tbody id="store_requests_container"> 
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
        $(document).ready(() => { getStoreRequests() });
    </script>
@endsection