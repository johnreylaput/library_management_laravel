<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Library Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #1e3c72 url('{{ asset('images/bg.png') }}') center/cover no-repeat fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem 0;
        }
        .register-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
        }
        .register-header {
            background: linear-gradient(135deg, rgba(30,60,114,0.85) 0%, rgba(42,82,152,0.85) 100%), url('{{ asset('images/lgn.png') }}') center/cover no-repeat;
            background-size: cover;
            background-position: center;
            color: #fff;
            padding: 3rem 2rem;
            text-align: center;
        }
        .register-logo {
            max-height: 160px;
            width: auto;
            display: inline-block;
        }
        .register-body {
            padding: 2rem;
        }
        .form-label {
            font-weight: 500;
            color: #333;
            font-size: 0.9rem;
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 0.65rem 1rem;
            font-size: 0.95rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #2a5298;
            box-shadow: 0 0 0 3px rgba(42, 82, 152, 0.1);
        }
        .input-group-text {
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 8px 0 0 8px;
        }
        .input-group > .form-control {
            border-left: none;
        }
        .input-group > .form-control:focus {
            border-left: 1px solid #2a5298;
        }
        .btn-register {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 600;
            width: 100%;
            color: #fff;
        }
        .btn-register:hover {
            opacity: 0.9;
            color: #fff;
        }
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #666;
        }
        .login-link a {
            color: #2a5298;
            font-weight: 600;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .alert {
            border-radius: 8px;
            font-size: 0.9rem;
        }
        .section-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #888;
            margin-bottom: 0.75rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="register-header">
            <img src="{{ asset('images/lgn.png') }}" alt="Library Management System" class="register-logo">
        </div>
        <div class="register-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="section-title">Personal Information</div>
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" required placeholder="Enter your full name">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-at"></i></span>
                            <input type="text" name="username" class="form-control" value="{{ old('username') }}" required placeholder="Choose username">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="Enter email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" id="registerPassword" class="form-control" required placeholder="Min. 8 characters">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('registerPassword', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="password_confirmation" id="registerPasswordConfirmation" class="form-control" required placeholder="Repeat password">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('registerPasswordConfirmation', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="section-title mt-3">Academic Information</div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Course</label>
                        <input type="text" name="course" class="form-control" value="{{ old('course') }}" placeholder="e.g. BSIT">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Year Level</label>
                        <select name="year_level" class="form-select">
                            <option value="">Select Year</option>
                            <option value="1st Year" {{ old('year_level') == '1st Year' ? 'selected' : '' }}>1st Year</option>
                            <option value="2nd Year" {{ old('year_level') == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                            <option value="3rd Year" {{ old('year_level') == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                            <option value="4th Year" {{ old('year_level') == '4th Year' ? 'selected' : '' }}>4th Year</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contact Number</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                        <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number') }}" placeholder="e.g. 09123456789">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="2" placeholder="Enter your address">{{ old('address') }}</textarea>
                </div>
                <button type="submit" class="btn btn-register">Create Account</button>
            </form>
            <div class="login-link">
                Already have an account? <a href="{{ route('login') }}">Sign in here</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
</body>
</html>
