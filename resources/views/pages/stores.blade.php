@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <h1>Stores</h1>
        <p>Choose a store to buy products</p>
    </div>
    <div class="row" id="stores_container">
        <!-- ============= APPEND HERE ============ -->
    </div>
@endsection

@section('scripts')
    <script src="/js/class/Store.js"></script>
    <script src="/js/user/stores.js"></script>
    <script>
        $(document).ready(() => { getStores() });
    </script>
@endsection