<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Dashboard sin areas -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name', 'Sermeind') }} | @yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/dist/img/tec.ico') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('admin/plugins/pace-progress/themes/black/pace-theme-flat-top.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/jquery-confirm/jquery-confirm.min.css') }}">

    @yield('styles-plugins')

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">

    <style>
        .dropdown-item.active, .dropdown-item:active{
            background-color: #ffffff !important;
        }

        .btn i {
            width: 1em; /* Ajusta el tamaño según sea necesario */
            height: 1em;
        }

        #body-notifications {
            max-height: 300px; /* Establece la altura máxima del contenedor para activar el scroll */
            overflow: auto;    /* Añade un scroll si el contenido supera la altura máxima */
        }
    </style>
    @yield('styles')

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini pace-primary layout-fixed layout-navbar-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- SEARCH FORM -->

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" id="showNotifications">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-danger navbar-badge" id="total_notifications"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header" id="quantity_notifications"></span>
                    <div class="dropdown-divider"></div>
                    <div id="body-notifications">

                    </div>
                    <template id="notification-unread">
                        <div class="dropdown-item" >
                            <p class="text-sm">
                                <i class="fas fa-envelope mr-2 text-danger"></i>
                                <span data-message="message" class="text-danger">Nueva cotizacion creada por Operador fgdfgdfgdfg</span>
                                <span class="float-right text-muted text-sm" data-time>Hace 3 mins</span>
                            </p>
                            <br>
                            <a href="#" style="margin-top: 20px" data-read data-content >
                                <span class="float-left text-sm">Marcar como leído</span>
                            </a>
                            <a href="#" style="margin-top: 20px" data-go>
                                <span class="float-right text-sm">Ir</span>
                            </a>
                        </div>
                    </template>
                    <template id="notification-read">
                        <div class="dropdown-item">
                            <p class="text-sm">
                                <i class="fas fa-envelope mr-2"></i>
                                <span data-message="message">Nueva cotizacion creada por Operador fgdfgdfgdfg</span>
                                <span class="float-right text-muted text-sm" data-time>Hace 3 mins</span>
                            </p>
                            <br>
                            <a href="#" style="margin-top: 20px" data-go>
                                <span class="float-right text-sm">Ir</span>
                            </a>
                        </div>
                    </template>

                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer" id="read-all">Marcar todos como leídos</a>
                </div>
            </li>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('images/users/user.png')}}" class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline">{{Auth::user()->name}}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="{{asset('images/users/user.png')}}" class="img-circle elevation-2" alt="User Image">

                        <p>
                            {{ Auth::user()->name }}
                            <small>Member since Nov. 2012</small>
                        </p>
                    </li>
                    <!-- Menu Body -->
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="" class="btn btn-default btn-flat">Perfil</a>
                        <a class="btn btn-default btn-flat float-right" href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i>
                            Cerrar sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
        <a href="{{ url('/') }}" class="brand-link">
            <img src="{{ asset('admin/dist/img/cine-logo-dashboard.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name', 'Blog') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('images/users/user.png')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ route('home') }}" class="d-block">Dashboard</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-header">ADMINISTRADOR</li>
                    <li class="nav-item has-treeview @yield('openAdmin')">

                        <a href="#" class="nav-link @yield('activeAdmin')">
                            <i class="nav-icon fab fa-blogger"></i>
                            <p>
                                POSTS
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('post.index') }}" class="nav-link @yield('activeListPost')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Lista de Post</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('post.create') }}" class="nav-link @yield('activeCreatePost')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Escribir Post</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="" class="nav-link @yield('activeProfile')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Perfil</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @yield('page-header')
                        {{--<h1 class="m-0 text-dark">Starter Page</h1>--}}

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        @yield('page-breadcrumb')
                        {{--<ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Starter Page</li>
                        </ol>--}}

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    @yield('page-title')
                    {{--<h5 class="card-title">Card header</h5>--}}
                </div>
                <div class="card-body" id="content-body">
                    @yield('content')
                    {{--<h5 class="card-title">Card title</h5>--}}
                </div>
                {{--<div class="card-footer text-muted">
                    <a href="#" class="btn btn-primary">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>--}}
            </div>
            @yield('content-report')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- Default to the left -->
        <strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="https://www.edesce.com/">EDESCE</a>.</strong> Todos los derechos reservados.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pace-progress/pace.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jquery-confirm/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
@yield('plugins')

<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>

@yield('scripts')

</body>
</html>
