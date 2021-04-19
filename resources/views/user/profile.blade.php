@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <ul class="list-group">
                <li class="list-group-item profile-image-container">
                    <img src="/images/avatar.jpg" alt="" class="img-circle">
                    <h3>{{ Auth::user()->fullName() }}</h3>
                </li>
                <li class="list-group-item">
                    <b>Email:</b> {{ Auth::user()->email }}
                </li>
                <li class="list-group-item">
                    <b>Address:</b> <i class="fa fa-map-marker"></i> {{ Auth::user()->address }}
                </li>
                <li class="list-group-item">
                    <b>Contact:</b> #{{ Auth::user()->contact }}
                </li>
                <li class="list-group-item">
                    <a href="{{ route('settings') }}" class="btn btn-default form-control">
                    Update Account
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#" class="btn btn-default form-control" data-toggle="modal" data-target=".bs-example-modal-lg">
                    Create Store
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="create_store_modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="create_store_form" autocomplete="off">
                    {{ @csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Create Store</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group name-form">
                            <label for="store_name">Store Name</label>
                            <input type="text" name="name" id="store_name" class="form-control" placeholder="Enter your store name">
                        </div>
                        <div class="form-group email-form">
                            <label for="store_email">Store Email</label>
                            <input type="email" name="email" id="store_email" class="form-control" placeholder="Enter your store email">
                        </div>
                        <div class="form-group address-form">
                            <label for="store_address">Store Address</label>
                            <input type="text" name="address" id="store_address" class="form-control" placeholder="Enter your store address">
                        </div>
                        <div class="form-group contact-form">
                            <label for="store_contact">Store Contact</label>
                            <input type="number" name="contact" id="store_contact" class="form-control" placeholder="Enter your store contact">
                        </div>
                        <div class="form-group image-form">
                            <label for="store_image">Store Image</label>
                            <input type="file" name="image" id="store_image" class="form-control" placeholder="Enter your store image">
                        </div>
                        <div class="form-group description-form">
                            <label for="store_description">Store Description</label>
                            <textarea name="description" id="store_description" cols="30" rows="10" placeholder="Enter your store description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-default">Create Store</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/functions/store_create.js"></script>
    <script src="/js/functions/errors.js"></script>
@endsection