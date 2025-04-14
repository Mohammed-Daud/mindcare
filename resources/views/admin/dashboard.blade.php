<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | MindCare Professional Counseling</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        .admin-sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
        }
        .admin-logo {
            text-align: center;
            padding: 0 20px 20px;
            border-bottom: 1px solid #495057;
        }
        .admin-logo h1 {
            font-size: 24px;
            margin: 0;
        }
        .admin-menu {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        .admin-menu li {
            margin-bottom: 5px;
        }
        .admin-menu a {
            display: block;
            padding: 10px 20px;
            color: #adb5bd;
            text-decoration: none;
            transition: all 0.3s;
        }
        .admin-menu a:hover, .admin-menu a.active {
            background-color: #495057;
            color: #fff;
        }
        .admin-menu i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        .admin-content {
            flex: 1;
            padding: 20px;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #dee2e6;
        }
        .admin-title {
            font-size: 24px;
            margin: 0;
        }
        .admin-user {
            display: flex;
            align-items: center;
        }
        .admin-user-name {
            margin-right: 15px;
        }
        .admin-user-logout {
            color: #dc3545;
            text-decoration: none;
        }
        .admin-user-logout:hover {
            text-decoration: underline;
        }
        .admin-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .admin-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .admin-card-title {
            font-size: 18px;
            margin-top: 0;
            margin-bottom: 15px;
            color: #495057;
        }
        .admin-card-value {
            font-size: 36px;
            font-weight: bold;
            margin: 0;
            color: #343a40;
        }
        .admin-card-icon {
            font-size: 24px;
            margin-right: 10px;
            color: #4a6cf7;
        }
        .admin-table {
            width: 100%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .admin-table table {
            width: 100%;
            border-collapse: collapse;
        }
        .admin-table th {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #495057;
            border-bottom: 1px solid #dee2e6;
        }
        .admin-table td {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
        }
        .admin-table tr:last-child td {
            border-bottom: none;
        }
        .admin-table tr:hover {
            background-color: #f8f9fa;
        }
        .admin-action {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            margin-right: 5px;
        }
        .admin-action-view {
            background-color: #4a6cf7;
            color: #fff;
        }
        .admin-action-edit {
            background-color: #ffc107;
            color: #212529;
        }
        .admin-action-delete {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-sidebar">
            <div class="admin-logo">
                <h1>MindCare Admin</h1>
            </div>
            <ul class="admin-menu">
                <li><a href="{{ route('admin.dashboard') }}" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.professionals.index') }}"><i class="fas fa-user-md"></i> Professionals</a></li>
                <li><a href="#"><i class="fas fa-users"></i> Users</a></li>
                <li><a href="#"><i class="fas fa-calendar-alt"></i> Appointments</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
            </ul>
        </div>
        
        <div class="admin-content">
            <div class="admin-header">
                <h2 class="admin-title">Dashboard</h2>
                <div class="admin-user">
                    <span class="admin-user-name">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="admin-user-logout" style="background: none; border: none; cursor: pointer;">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="admin-cards">
                <div class="admin-card">
                    <h3 class="admin-card-title"><i class="fas fa-user-md admin-card-icon"></i> Total Professionals</h3>
                    <p class="admin-card-value">24</p>
                </div>
                <div class="admin-card">
                    <h3 class="admin-card-title"><i class="fas fa-users admin-card-icon"></i> Total Users</h3>
                    <p class="admin-card-value">156</p>
                </div>
                <div class="admin-card">
                    <h3 class="admin-card-title"><i class="fas fa-calendar-check admin-card-icon"></i> Appointments Today</h3>
                    <p class="admin-card-value">12</p>
                </div>
            </div>
            
            <h3>Recent Professionals</h3>
            <div class="admin-table">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Specialization</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Dr. John Smith</td>
                            <td>john.smith@example.com</td>
                            <td>Psychologist</td>
                            <td><span style="color: #28a745;">Approved</span></td>
                            <td>
                                <a href="#" class="admin-action admin-action-view"><i class="fas fa-eye"></i></a>
                                <a href="#" class="admin-action admin-action-edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="admin-action admin-action-delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Dr. Sarah Johnson</td>
                            <td>sarah.johnson@example.com</td>
                            <td>Psychiatrist</td>
                            <td><span style="color: #ffc107;">Pending</span></td>
                            <td>
                                <a href="#" class="admin-action admin-action-view"><i class="fas fa-eye"></i></a>
                                <a href="#" class="admin-action admin-action-edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="admin-action admin-action-delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Dr. Michael Brown</td>
                            <td>michael.brown@example.com</td>
                            <td>Counselor</td>
                            <td><span style="color: #dc3545;">Rejected</span></td>
                            <td>
                                <a href="#" class="admin-action admin-action-view"><i class="fas fa-eye"></i></a>
                                <a href="#" class="admin-action admin-action-edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="admin-action admin-action-delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html> 