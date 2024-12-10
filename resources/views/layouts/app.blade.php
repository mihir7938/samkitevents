<!DOCTYPE html>
<html lang="en">
<head>
    <title>Samkit Events</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/daterangepicker.css')}}">
	@yield('header')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="loader">
        <div class="loader-inner">
            <img src="{{asset('images/loading.gif')}}" alt="" style="width: 100%;">
        </div>
    </div>
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto align-items-center">
                @if(Auth::check())
                    <li class="nav-item mr-3">
                        Welcome {{Auth::user()->name}},
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{route('logout')}}">
                            Logout
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-primary mr-2" href="{{route('admin.login')}}">
                            Admin Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{route('login')}}">
                            Admin User Login
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{route('index')}}" class="brand-link">
              <img src="{{asset('images/logo.png')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
              <span class="brand-text font-weight-light">Samkit Events</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        @if(Auth::check())
                            <li class="nav-item">
                                <a href="{{route('users.index')}}" class="nav-link {{(Route::currentRouteName() == 'users.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('users.yatriks')}}" class="nav-link {{(Route::currentRouteName() == 'users.yatriks') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Yatriks</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('users.attendance')}}" class="nav-link {{(Route::currentRouteName() == 'users.attendance') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-step-backward"></i>
                                    <p>Start Event</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('users.attendance.end')}}" class="nav-link {{(Route::currentRouteName() == 'users.attendance.end') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-step-forward"></i>
                                    <p>End Event</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('users.gift')}}" class="nav-link {{(Route::currentRouteName() == 'users.gift') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-gift"></i>
                                    <p>Gift</p>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{route('index')}}" class="nav-link {{(Route::currentRouteName() == 'index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>Home</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('about')}}" class="nav-link {{(Route::currentRouteName() == 'about') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-id-badge"></i>
                                    <p>About Us</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('contact')}}" class="nav-link {{(Route::currentRouteName() == 'contact') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-envelope"></i>
                                    <p>Contact Us</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            @yield('content')
        </div>
        <footer class="main-footer">
            Copyright &copy; 2024 Samkit Events. All rights reserved.
        </footer>
    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/jszip.min.js')}}"></script>
    <script src="{{asset('js/buttons.html5.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/daterangepicker.js')}}"></script>
    <script src="{{asset('js/jquery.overlayScrollbars.min.js')}}"></script>
    <script src="{{asset('js/adminlte.js')}}"></script>
    @yield('footer')
</body>
</html>