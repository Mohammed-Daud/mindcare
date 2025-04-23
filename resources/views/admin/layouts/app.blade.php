<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MindCare Admin Dashboard - Professional Counseling Management">
    <meta name="author" content="MindCare">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin Dashboard') | MindCare Admin</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    <!-- Custom styles -->
    <style>
        .content-wrapper {
            background-color: #f4f6f9;
        }
        .card {
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
            margin-bottom: 1rem;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .btn-sm {
            margin: 0 2px;
        }
        .navbar-badge {
            font-size: .6rem;
            font-weight: 300;
            padding: 2px 4px;
            position: absolute;
            right: 5px;
            top: 9px;
        }
        .dropdown-menu-lg {
            max-width: 300px;
            min-width: 280px;
            padding: 0;
        }
        .dropdown-menu-lg .dropdown-item {
            padding: .5rem 1rem;
        }
        .dropdown-menu-lg .dropdown-divider {
            margin: 0;
        }
    </style>
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('admin.partials.navbar')

        <!-- Main Sidebar Container -->
        @include('admin.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('title', 'Dashboard')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                @yield('breadcrumb')
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Success!</h5>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('admin.partials.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
    <!-- Custom Scripts -->
    <script>
        $(document).ready(function() {
            // Initialize AdminLTE components
            $('body').Layout('fix');
            
            // Auto-hide alerts after 5 seconds
            $('.alert').delay(5000).fadeOut(500);

            // Enable tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Enable popovers
            $('[data-toggle="popover"]').popover();

            // Handle confirmation dialogs
            $('[data-confirm]').on('click', function(e) {
                if (!confirm($(this).data('confirm'))) {
                    e.preventDefault();
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html> 