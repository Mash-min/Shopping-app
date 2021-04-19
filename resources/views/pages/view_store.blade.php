@extends('layouts.app')

@section('content')
    {{ @csrf_field() }}
    <input type="hidden" name="store_id" id="store_id" value='{{ $store->id }}'>
    <div class="row">
            <div class="col-md-4">
                <div class="thumbnail">
                    @if($store->image != 'none')
                        <img src="/storage/images/store_images/{{ $store->id }}/{{$store->image}}" alt="...">
                    @else
                        <img src="/images/avatar.jpg" alt="...">
                    @endif
                </div>
            </div>
        <div>
            </div>
                <div class="col-md-8" id="store_details_container">
                    <!-- APPEND HERE -->
                </div>
            </div>
        <div class="panel panel-default" style="margin-top: 20px;">
            <div class="panel-heading">
                <h4>Store products</h4>
            </div>
            <div class="panel-body" id="store_products_container">
                <!-- APPEND HERE -->
                <div class="col-md-12 loader-div-item"></div>
                <div class="col-md-12 loader-div-item"></div>
                <div class="col-md-12 loader-div-item"></div>
                <div class="col-md-12 loader-div-item"></div>
            </div>
        </div>
        @if($store->products()->count() > 8)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <button class="btn btn-default form-control" id="load_more_products">
                        Load more
                    </button>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script src="/js/class/Store.js"></script>
    <script src="/js/functions/store_find.js"></script>
    <script>
        $(document).ready(() => { 
            getStoreProducts(); 
            getStoreDetails('{{ $store->id }}');
        });
    </script>
@endsection