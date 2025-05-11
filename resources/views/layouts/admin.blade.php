<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | أنس Admin</title>
    
    <!-- Google Fonts - Tajawal for Arabic support -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2c5fa8;
            --secondary-color: #e6b45a;
            --dark-color: #1a2b4a;
            --light-color: #f8f5ee;
            --success-color: #4caf50;
            --danger-color: #f44336;
        }
        
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        
        .sidebar {
            width: 280px;
            min-height: 100vh;
            background: var(--dark-color);
            color: white;
            position: fixed;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .main-content {
            margin-right: 280px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            border-right: 4px solid transparent;
            transition: all 0.3s;
        }
        
        .nav-link:hover, .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            border-right: 4px solid var(--secondary-color);
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-warning {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: #333;
        }
        
        .list-group-item {
            border: none;
            margin-bottom: 10px;
            border-radius: 8px !important;
            transition: all 0.3s;
        }
        
        .list-group-item:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }
        
        @media (max-width: 992px) {
            .sidebar {
                margin-right: -280px;
            }
            
            .sidebar.active {
                margin-right: 0;
            }
            
            .main-content {
                margin-right: 0;
            }
            
            .overlay {
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
                display: none;
            }
            
            .sidebar.active ~ .overlay {
                display: block;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header text-center py-4">
            <img src="http://localhost/ans/resources/public/images/logo.png" alt="Islamic App Logo1" class="img-fluid" style="max-height: 50px;">
            <h4 class="mt-3 mb-0">أنس</h4>
        </div>
        
        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a href="{{ route('contents.index') }}" class="nav-link {{ request()->routeIs('contents.*') ? 'active' : '' }}">
                    <i class="fas fa-book-quran me-2"></i> Islamic Contents
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('category.index') }}" class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
                    <i class="fas fa-tags me-2"></i> Categories
                </a>
            </li>
            <li class="nav-item mt-4">
                <form action="{{ route('logout.admin') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link text-start w-100">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
    
    <div class="main-content">
        @include('partials.header')
        
        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </div>
    
    <div class="overlay"></div>
    
    @include('partials.scripts')
    @stack('scripts')
</body>
</html>