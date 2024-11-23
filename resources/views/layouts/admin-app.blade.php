<!DOCTYPE html>
<html lang="en">
<head>
    <title>Samkit Events</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{asset('admin/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/css/admin.min.css?v=1.0')}}" crossorigin="anonymous" media='all'>
    <link rel="stylesheet" href="{{asset('admin/css/admin-custom.css?v=1.0')}}" crossorigin="anonymous" media='all'>
    <link rel="stylesheet" href="{{asset('admin/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap-datepicker.css')}}">
	@yield('header')
</head>
<body id="page-top">
    <div class="loader">
        <div class="loader-inner">
            <img src="{{asset('images/loading.gif')}}" alt="" style="width: 100%;">
        </div>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.index')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Samkit Events</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <li class="nav-item {{ (Route::currentRouteName() == 'admin.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('admin.index')}}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item {{ ((Route::currentRouteName() == 'admin.users') || (Route::currentRouteName() == 'admin.users.add') || (Route::currentRouteName() == 'admin.users.edit')) ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseZero"
                    aria-expanded="true" aria-controls="collapseZero">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Users</span>
                </a>
                <div id="collapseZero" class="collapse {{ ((Route::currentRouteName() == 'admin.users') || (Route::currentRouteName() == 'admin.users.add') || (Route::currentRouteName() == 'admin.users.edit')) ? 'show' : '' }}" aria-labelledby="headingZero" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Route::currentRouteName() == 'admin.users' ? 'active' : '' }}" href="{{route('admin.users')}}">All Users</a>
                        <a class="collapse-item {{ Route::currentRouteName() == 'admin.users.add' ? 'active' : '' }}" href="{{route('admin.users.add')}}">Add New User</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ ((Route::currentRouteName() == 'admin.events') || (Route::currentRouteName() == 'admin.events.add') || (Route::currentRouteName() == 'admin.events.edit') || (Route::currentRouteName() == 'admin.events.list')|| (Route::currentRouteName() == 'admin.events.edit.day')) ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Events</span>
                </a>
                <div id="collapseOne" class="collapse {{ ((Route::currentRouteName() == 'admin.events') || (Route::currentRouteName() == 'admin.events.add') || (Route::currentRouteName() == 'admin.events.edit') || (Route::currentRouteName() == 'admin.events.list') || (Route::currentRouteName() == 'admin.events.edit.day')) ? 'show' : '' }}" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Route::currentRouteName() == 'admin.events' ? 'active' : '' }}" href="{{route('admin.events')}}">All Events</a>
                        <a class="collapse-item {{ Route::currentRouteName() == 'admin.events.add' ? 'active' : '' }}" href="{{route('admin.events.add')}}">Add New Event</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ ((Route::currentRouteName() == 'admin.yatriks') || (Route::currentRouteName() == 'admin.yatriks.add') || (Route::currentRouteName() == 'admin.yatriks.edit') || (Route::currentRouteName() == 'admin.yatriks.view') || (Route::currentRouteName() == 'admin.yatriks.import') || (Route::currentRouteName() == 'admin.yatriks.assign')) ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Yatriks</span>
                </a>
                <div id="collapseTwo" class="collapse {{ ((Route::currentRouteName() == 'admin.yatriks') || (Route::currentRouteName() == 'admin.yatriks.add') || (Route::currentRouteName() == 'admin.yatriks.edit') || (Route::currentRouteName() == 'admin.yatriks.view') || (Route::currentRouteName() == 'admin.yatriks.import') || (Route::currentRouteName() == 'admin.yatriks.assign')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Route::currentRouteName() == 'admin.yatriks' ? 'active' : '' }}" href="{{route('admin.yatriks')}}">All Yatriks</a>
                        <a class="collapse-item {{ Route::currentRouteName() == 'admin.yatriks.add' ? 'active' : '' }}" href="{{route('admin.yatriks.add')}}">Add New Yatrik</a>
                        <a class="collapse-item {{ Route::currentRouteName() == 'admin.yatriks.import' ? 'active' : '' }}" href="{{route('admin.yatriks.import')}}">Import Yatriks</a>
                        <a class="collapse-item {{ Route::currentRouteName() == 'admin.yatriks.assign' ? 'active' : '' }}" href="{{route('admin.yatriks.assign')}}">Assign Yatriks</a>
                    </div>
                </div>
            </li>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{asset('images/undraw_profile.svg')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('logout')}}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @include('shared.alert')
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; {{env('APP_NAME')}} {{date('Y')}}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <script> 
        const baseUrl = "{{url('/')}}";
    </script>
    <script src="{{asset('admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/additional-methods.min.js"></script>
    <script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('js/validation-additional.js')}}"></script>
    <script type="text/javascript">
        $('.custom-file-input').on('change', function(e) {
            if(e.target.files.length == 1) {
                let fileName = $(this).val().split('\\').pop();
                $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
            } else {
                $(this).siblings('.custom-file-label').addClass('selected').html(e.target.files.length+" files selected");
            }
        });
        $(document).ready(function() {
            $('#dataTable').DataTable();
            $("#start_date").datepicker({
                'format': 'dd/mm/yyyy',
                'startDate': '-0m',
                'autoclose': true
            }).on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#end_date').datepicker('setStartDate', minDate);
                $(this).valid();
            });
            $("#end_date").datepicker({
                'format': 'dd/mm/yyyy',
                'startDate': '-0m',
                'autoclose': true
            }).on('changeDate', function (selected) {
                var maxDate = new Date(selected.date.valueOf());
                $('#start_date').datepicker('setEndDate', maxDate);
                $(this).valid();
            });
        });
    </script>
    @yield('footer')
</body>
</html>