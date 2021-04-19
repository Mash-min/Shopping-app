<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/bootstrap.css">
		<link rel="stylesheet" href="/css/navbar-fixed-side.css">
		<link rel="stylesheet" href="/css/index.css">
		<link rel="stylesheet" href="/css/font-awesome.css">
		<link rel="stylesheet" href="/css/jquery.fancybox.min.css">
    </head>
    <body>
        <div id="app">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3 col-lg-2">
                        <nav class="navbar navbar-default navbar-fixed-side">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <i class="fa fa-bars"></i>
                                    </button>
                                    <a class="navbar-brand" href="/"><i class="fa fa-shopping-cart"></i> Shopping App</a>
                                </div>

                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Buy Now <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('products') }}"> Products</a></li>
                                                <li><a href="#"> Categories</a></li>
                                                <li><a href="{{ route('stores') }}"> </i>Stores</a></li>
                                            </ul>
                                        </li>
                                        @auth
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    Account <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ route('profile') }}">Profile</a></li>
                                                    <li>
                                                        <a href="{{ route('notifications') }}">
                                                            Notifications 
                                                            <span class="badge navbar-badge">4</span>
                                                        </a>
                                                    </li>
                                                    <li><a href="{{ route('my_cart') }}">My Cart</a></li>
                                                    <li><a href="{{ route('my_orders') }}">My Orders</a></li>
                                                    <li><a href="{{ route('saved_products') }}">Saved Products</a></li>
                                                    <li><a href="{{ route('followed_stores') }}">Followed Stores</a></li>
                                                    <li>
                                                        <a href="#" onclick="logoutUser()">Logout</a>
                                                    </li>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        {{ @csrf_field() }}
                                                    </form>
                                                </ul>
                                            </li>
                                            @if(Auth::user()->alreadyHaveStore())
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                        My Store <span class="caret"></span>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('my_store') }}"> 
                                                                {{Auth::user()->store()->first()->name}} 
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('store_order') }}"> 
                                                                Store Orders
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('add_products') }}"> 
                                                                Add products
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('archives') }}"> 
                                                                Archives
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            @endif
                                        @endauth

                                        @guest
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    Join us <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="javscript.void(0)" data-toggle="modal" data-target="#registerModal">
                                                            <i class="fa fa-user"></i> Register
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javscript.void(0)" data-toggle="modal" data-target="#loginModal">
                                                            <i class="fa fa-user"></i> Login
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        @endguest
                                    </ul>
                                </div><!-- /.navbar-collapse -->
                                
                            </div><!-- /.container-fluid -->
                        </nav>
                    </div>
                    <div class="col-sm-9 col-lg-10 content">
                        @yield('content')
                    </div>
                </div>

                @guest
                    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h2 class="modal-title" id="myModalLabel">Register</h2>
                                    </div>
                                    <form id="register_user_form" autocomplete="off">
                                        {{ @csrf_field() }}
                                        <div class="modal-body">
                                            <div class="form-group firstname-form">
                                                <label for="firstname">Firstname</label>
                                                <input type="text" name="firstname" placeholder="Enter your firstname" class="form-control">
                                            </div>
                                            <div class="form-group lastname-form">
                                                <label for="lastname">Lastname</label>
                                                <input type="text" name="lastname" placeholder="Enter your lastname" class="form-control">
                                            </div>
                                            <div class="form-group contact-form">
                                                <label for="contact">Contact</label>
                                                <input type="number" name="contact" placeholder="Enter your contact" class="form-control">
                                            </div>
                                            <div class="form-group address-form">
                                                <label for="address">Address</label>
                                                <input type="text" name="address" placeholder="Enter your address" class="form-control">
                                            </div>
                                            <div class="form-group email-form">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" placeholder="Enter your email" class="form-control">
                                            </div>
                                            <div class="form-group password-form">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" placeholder="Enter your password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="password_confirmation">Password confirmation</label>
                                                <input type="password" name="password_confirmation" placeholder="Re-Enter your password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-default">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h2 class="modal-title" id="myModalLabel">Login</h2>
                                    </div>
                                <form id="user_login_form" autocomplete="off">
                                    {{ @csrf_field() }}
                                    <div class="modal-body login-modal">
                                        <div class="form-group login-inp">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" placeholder="Enter your email" class="form-control">
                                        </div>
                                        <div class="form-group login-inp">
                                            <label for="password">Password</label>
                                            <input type="password" name="password"placeholder="Enter your password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-default">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </body>
        <script src="/js/jquery-3.2.1.min.js"></script>
        <script src="/js/sweetalert.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/index.js"></script>
        <script src="/js/jquery.fancybox.min.js"></script>
        @yield('scripts')
</html>
