@extends('layouts.app')

@section('content')
    {{ @csrf_field() }}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Followed Stores</h3>
        </div>
        <div class="panel-body">
            <div class="row" id="saved_stores_container">
                <!-- APPEND HERE -->
            </div> 
        </div>
    </div>        
@endsection

@section('scripts')
    <script src="/js/class/Store.js"></script>
    <script src="/js/functions/store_find.js"></script>
    <script>
        $(document).ready(function() {
            UserStore.savedStores();
        })
    </script>
@endsection