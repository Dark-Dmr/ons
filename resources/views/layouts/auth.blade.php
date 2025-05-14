<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أُنس Admin - Login</title>
    
    <!-- Google Fonts - Tajawal for Arabic support -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
            background: linear-gradient(135deg, var(--dark-color) 0%, var(--primary-color) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-card {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            background-color: white;
            max-width: 450px;
            width: 100%;
        }
        
        .login-header {
            background: var(--primary-color);
            padding: 2.5rem 2rem 3.5rem;
            text-align: center;
            position: relative;
            border-radius: 20px 20px 0 0;
        }
        
        .login-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            background: white;
            border-radius: 50% 50% 0 0;
            transform: translateY(15px);
        }
        
        .login-logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            padding: 15px;
            margin: 0 auto 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-logo i {
            color: var(--primary-color);
            font-size: 2rem;
        }
        
        .login-header h2 {
            color: white;
            margin: 0;
            font-weight: 700;
        }
        
        .login-body {
            padding: 2.5rem;
        }
        
        .form-floating {
            margin-bottom: 1.5rem;
        }
        
        .form-floating > .form-control {
            padding: 1.5rem 1rem 0.5rem;
            height: calc(3.75rem + 2px);
            border-radius: 10px;
            border: 2px solid #e9ecef;
        }
        
        .form-floating > label {
            padding: 1rem 1rem;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(44, 95, 168, 0.15);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 10px;
            padding: 12px 20px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: var(--dark-color);
            border-color: var(--dark-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .alert-danger {
            background-color: rgba(244, 67, 54, 0.1);
            color: var(--danger-color);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="login-card mx-auto">
            <div class="login-header">
                <div class="login-logo">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h2>لوحة إدارة أُنس</h2>
            </div>
            
            <div class="login-body">
                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    </div>
                @endif
                
                <form action="{{ route('login.admin') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-4">
                        <input type="email" class="form-control" id="email" name="email" placeholder="البريد الإلكتروني" required>
                        <label for="email"><i class="fas fa-envelope me-2"></i> البريد الإلكتروني</label>
                    </div>
                    
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="password" name="password" placeholder="كلمة المرور" required>
                        <label for="password"><i class="fas fa-lock me-2"></i> كلمة المرور</label>
                    </div>
                    
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i> تسجيل الدخول
                        </button>
                    </div>
                </form>
                
                <div class="login-footer">
                    <p class="mb-0">© 2025 أُنس - جميع الحقوق محفوظة</p>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>