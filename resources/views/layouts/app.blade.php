<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DISBURSEMENTS</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('theme/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('theme/dist/css/adminlte.min.css') }}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        @yield('css')
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('theme/dist/img/user-profile.png') }}" class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header" style="background-color: #343A40">
                                <img src="{{ asset('theme/dist/img/user-profile.png') }}" class="img-circle elevation-2" alt="User Image">
                                <p style="color: #ffffff">
                                    {{ Auth::user()->name }}
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="{{ route('user.profile') }}" class="btn btn-default btn-flat">Profile</a>
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="brand-link" style="text-align: center">
                <span class="brand-text"><b>DISBURSEMENTS</b></span>
                </a>
                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                                with font-awesome or any other icon font library -->

                            @permission('home-view')
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link {{ request()->is('/') || request()->is('home') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Home
                                    </p>
                                </a>
                            </li>
                            @endpermission
                            @permission('disbursement-view')
                            <li class="nav-item has-treeview
                                {{ request()->is('disbursement*') ? 'menu-open' : ''}}
                            ">
                                <a href="#" class="nav-link
                                {{ request()->is('disbursement*') ? 'menu-open' : ''}}
                                ">
                                    <i class="nav-icon fas fa-money-bill-alt"></i>
                                    <p>
                                        Disbursement
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @permission('disbursement-create')
                                    <li class="nav-item">
                                        <a href="{{ route('disbursement.create') }}" class="nav-link {{ request()->is('disbursement/create') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Create</p>
                                        </a>
                                    </li>
                                    @endpermission
                                    @permission('disbursement-list')
                                    <li class="nav-item">
                                        <a href="{{ route('disbursement.list') }}" class="nav-link {{ request()->is('disbursement/list') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>List</p>
                                        </a>
                                    </li>
                                    @endpermission
                                    @permission('disbursement-check-status')
                                    <li class="nav-item">
                                        <a href="{{ route('disbursement.checkstatus') }}" class="nav-link {{ request()->is('disbursement/checkstatus') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Check Status</p>
                                        </a>
                                    </li>
                                    @endpermission
                                </ul>
                            </li>
                            @endpermission
                            @permission('user-management-view')
                            <li class="nav-item has-treeview
                            {{ request()->is('role*') ||
                                request()->is('permission*') ||
                                request()->is('user*') ? 'menu-open' : ''
                            }}
                            ">
                                <a href="#" class="nav-link
                                {{ request()->is('role*') ||
                                    request()->is('permission*') ||
                                    request()->is('user*') ? 'active' : ''
                                }}
                                ">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        User Management
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @permission('role*')
                                    <li class="nav-item">
                                        <a href="{{ route('role') }}" class="nav-link {{ request()->is('role*') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Role</p>
                                        </a>
                                    </li>
                                    @endpermission
                                    @permission('permission*')
                                    <li class="nav-item">
                                        <a href="{{ route('permission') }}" class="nav-link {{ request()->is('permission*') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Permission</p>
                                        </a>
                                    </li>
                                    @endpermission
                                    @permission('user*')
                                    <li class="nav-item">
                                        <a href="{{ route('user') }}" class="nav-link  {{ request()->is('user*') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>User</p>
                                        </a>
                                    </li>
                                    @endpermission
                                </ul>
                            </li>
                            @endpermission
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
            @yield('content')
            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 1.0.0
                </div>
                <strong>Copyright &copy; {{ date('Y') }} <a href="{{ route('home') }}">Ado Pabianko</a>.</strong> All rights
                reserved.
            </footer>
        </div>
        <!-- ./wrapper -->
        <!-- jQuery -->
        <script src="{{ asset('theme/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('theme/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('theme/dist/js/adminlte.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('theme/dist/js/demo.js') }}"></script>
        @yield('js')
    </body>
</html>
