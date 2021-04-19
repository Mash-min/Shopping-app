@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <h1>Shopping App</h1>
        <p>Buy your products now</p>
        <p><a class="btn btn-default btn-lg" href="{{ route('products') }}" role="button">Get started</a></p>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="thumbnail">
                <div class="caption">
                    <h3 class="center">Create your own Store</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur cum nemo laudantium possimus</p>
                    <p class="center">
                    <a href="/" class="btn btn-default form-control">Get started</a> 
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="thumbnail">
                <div class="caption">
                    <h3 class="center">Buy some Products</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur cum nemo laudantium possimus</p>
                    <p class="center">
                    <a href="{{ route('products') }}" class="btn btn-default form-control" role="button">Get started</a> 
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="thumbnail">
                <div class="caption">
                    <h3 class="center">Add to your Cart</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur cum nemo laudantium possimus</p>
                    <p class="center">
                    <a href="{{ route('products') }}" class="btn btn-default form-control" role="button">Get started</a> 
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="/js/functions/errors.js"></script>
@endsection