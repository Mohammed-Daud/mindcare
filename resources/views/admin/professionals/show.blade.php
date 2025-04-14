<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Professional Details | MindCare Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@2.4.18/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
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
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link">
                <span class="brand-text font-weight-light">MindCare Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.professionals.index') }}" class="nav-link active">
                                <i class="nav-icon fas fa-user-md"></i>
                                <p>Professionals</p>
                            </a>
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
                            <h1>Professional Details</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.professionals.index') }}">Professionals</a></li>
                                <li class="breadcrumb-item active">Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        @if($professional->profile_photo)
                                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/' . $professional->profile_photo) }}" alt="User profile picture">
                                        @else
                                            <img class="profile-user-img img-fluid img-circle" src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.18/img/user2-160x160.jpg" alt="User profile picture">
                                        @endif
                                    </div>

                                    <h3 class="profile-username text-center">{{ $professional->first_name }} {{ $professional->last_name }}</h3>

                                    <p class="text-muted text-center">{{ $professional->specialization ?? 'Mental Health Professional' }}</p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Status</b> 
                                            @if($professional->status == 'pending')
                                                <span class="float-right badge badge-warning">Pending</span>
                                            @elseif($professional->status == 'approved')
                                                <span class="float-right badge badge-success">Approved</span>
                                            @else
                                                <span class="float-right badge badge-danger">Rejected</span>
                                            @endif
                                        </li>
                                        <li class="list-group-item">
                                            <b>Applied On</b> <span class="float-right">{{ $professional->created_at->format('M d, Y') }}</span>
                                        </li>
                                    </ul>

                                    @if($professional->status == 'pending')
                                        <div class="row">
                                            <div class="col-6">
                                                <form action="{{ route('admin.professionals.approve', $professional) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-block" onclick="return confirm('Are you sure you want to approve this professional?')">
                                                        <i class="fas fa-check"></i> Approve
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-6">
                                                <form action="{{ route('admin.professionals.reject', $professional) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to reject this professional?')">
                                                        <i class="fas fa-times"></i> Reject
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- About Me Box -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">About</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                                    <p class="text-muted">{{ $professional->email }}</p>

                                    <hr>

                                    <strong><i class="fas fa-phone mr-1"></i> Phone</strong>
                                    <p class="text-muted">{{ $professional->phone ?? 'Not provided' }}</p>

                                    <hr>

                                    <strong><i class="fas fa-graduation-cap mr-1"></i> Qualification</strong>
                                    <p class="text-muted">{{ $professional->qualification ?? 'Not provided' }}</p>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#details" data-toggle="tab">Details</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#bio" data-toggle="tab">Bio</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#documents" data-toggle="tab">Documents</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="details">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th style="width: 200px">First Name</th>
                                                    <td>{{ $professional->first_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Last Name</th>
                                                    <td>{{ $professional->last_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td>{{ $professional->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Phone</th>
                                                    <td>{{ $professional->phone ?? 'Not provided' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Specialization</th>
                                                    <td>{{ $professional->specialization ?? 'Not specified' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Qualification</th>
                                                    <td>{{ $professional->qualification ?? 'Not provided' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>License Number</th>
                                                    <td>{{ $professional->license_number ?? 'Not provided' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>License Expiry Date</th>
                                                    <td>{{ $professional->license_expiry_date ?? 'Not provided' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Application Status</th>
                                                    <td>
                                                        @if($professional->status == 'pending')
                                                            <span class="badge badge-warning">Pending</span>
                                                        @elseif($professional->status == 'approved')
                                                            <span class="badge badge-success">Approved</span>
                                                        @else
                                                            <span class="badge badge-danger">Rejected</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Applied On</th>
                                                    <td>{{ $professional->created_at->format('F j, Y') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="bio">
                                            <div class="card-body">
                                                <p>{{ $professional->bio ?? 'No bio provided.' }}</p>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="documents">
                                            <div class="card-body">
                                                @if($professional->cv)
                                                    <div class="mb-3">
                                                        <h5>CV/Resume</h5>
                                                        <a href="{{ asset('storage/' . $professional->cv) }}" class="btn btn-primary" target="_blank">
                                                            <i class="fas fa-file-pdf"></i> View CV
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="mb-3">
                                                        <h5>CV/Resume</h5>
                                                        <p>No CV uploaded.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; {{ date('Y') }} <a href="{{ route('home') }}">MindCare</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@2.4.18/dist/js/adminlte.min.js"></script>
</body>
</html> 