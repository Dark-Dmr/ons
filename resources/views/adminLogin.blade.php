<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark border-danger">
                    <h3 class="text-center text-danger mb-0">Login</h3>
                </div>
                
                <div class="card-body">
                    @if(session()->has('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>    
                    @endif

                    <form action="{{route('login.admin')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-light">Email address</label>
                            <input type="email" class="form-control bg-dark text-light" name="email" placeholder="Enter your email">
                            <div class="form-text text-muted">We'll never share your email with anyone else.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-light">Password</label>
                            <input type="password" class="form-control bg-dark text-light" name="password" placeholder="Enter your password">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger btn-lg">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</body>
</html>