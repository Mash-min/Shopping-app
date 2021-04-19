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
            {{ @csrf_field() }}
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
                                    <a class="navbar-brand" href="/"><i class="fa fa-user-circle-o"></i> Admin Panel</a>
                                </div>

                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Account <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                                <li><a href="{{ route('profile') }}">Profile</a></li>
                                                <li>
                                                    <a href="#" onclick="logoutUser()">Logout</a>
                                                </li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ @csrf_field() }}
                                                </form>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Users <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('profile') }}">User Accounts</a></li>
                                                <li><a href="{{ route('profile') }}">User Archive</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Stores <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('store_list') }}">Store List</a></li>
                                                <li><a href="{{ route('store_requests') }}">Store Requests</a></li>
                                                <li><a href="{{ route('store_owners') }}">Store Owners</a></li>
                                                <li><a href="{{ route('store_archive') }}">Store Archive</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Products <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('product_list') }}">Product List</a></li>
                                                <li><a href="{{ route('product_requests') }}">Product Requests</a></li>
                                                <li><a href="{{ route('product_archive') }}">Product Archive</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                Orders <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('profile') }}">Pending Orders</a></li>
                                                <li><a href="{{ route('profile') }}">Delivered Orders</a></li>
                                                <li><a href="{{ route('profile') }}">Canceled Orders</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div><!-- /.navbar-collapse -->
                                
                            </div><!-- /.container-fluid -->
                        </nav>
                    </div>
                    <div class="col-sm-9 col-lg-10 content">
                        @yield('content')
                    </div>
                </div>
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
