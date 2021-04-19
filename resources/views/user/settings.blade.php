@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form autocomplete="off" id="update_account_form">
                {{ @csrf_field() }}
                <ul class="list-group">
                    <li class="list-group-item">
                        <h3 class="text-center">Account Settings</h3>
                    </li>
                    <li class="list-group-item profile-image-container">
                        <img src="/images/avatar.jpg" alt="" class="img-circle">
                    </li>
                    <li class="list-group-item">
                        <div class="form-group">
                            <button class="btn btn-default form-control" type='button' data-toggle="modal" data-target="#updateImageModal">
                                <i class="fa fa-image"></i>
                            </button>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-group firstname-form">
                            <label for="firstname">Firstname:</label>
                            <input type="text" name="firstname" class="form-control" placeholder="Enter your firstname" value="{{ Auth::user()->firstname }}">
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-group lastname-form">
                            <label for="lastname">Lastname:</label>
                            <input type="text" name="lastname" class="form-control" placeholder="Enter your lastname" value="{{ Auth::user()->lastname }}">
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-group email-form">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ Auth::user()->email }}">
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-group contact-form">
                            <label for="contact">Contact:</label>
                            <input type="number" name="contact" class="form-control" placeholder="Enter your contact" value="{{ Auth::user()->contact }}">
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-group address-form">
                            <label for="address">Address:</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter your address" value="{{ Auth::user()->address }}">
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-group">
                            <button class="btn btn-default form-control" type="button" id="reset_password_btn">
                                Reset Password <i class="fa fa-lock"></i>
                            </button>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <button class="btn btn-default form-control" type="submit">
                        Save changes
                        </button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <div class="modal fade" id="updateImageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update Profile Image</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/user/user_update.js"></script>
    <script src="/js/user/user_errors.js"></script>
@endsection