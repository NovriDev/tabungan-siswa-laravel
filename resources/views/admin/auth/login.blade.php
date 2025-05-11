<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | Tabungan Siswa</title>
    <link rel="shortcut icon" type="image/png"
        href="{{ asset('template-admin/src/assets/images/logos/logojidan.png') }}" />
    <link rel="stylesheet" href="{{ asset('template-admin/src/assets/css/styles.min.css') }}" />
    <style>
        body {
            background: linear-gradient(to bottom right, #4e54c8, #8f94fb);
            font-family: 'Roboto', sans-serif;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background-color: #4e54c8;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #8f94fb;
        }

        .text-center h4 {
            font-weight: bold;
            color: #4e54c8;
        }

        .form-control {
            border-radius: 10px;
        }

        .form-label {
            font-weight: bold;
            color: #4e54c8;
        }

        .forgot-password {
            text-align: right;
            font-size: 0.9rem;
            color: #8f94fb;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 100px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .secure-login {
        font-size: 0.9rem;
        color: #ffffff;
        text-align: center;
        margin-top: 10px;
    }

    .secure-login i {
        color: #ffffff;
    }
    </style>
</head>

<body>
    <div class="secure-login">
        <i class="ti ti-lock"></i> Akses Aman - Pastikan Anda berada di situs resmi kami.
    </div>    
    <!-- Body Wrapper -->
    <div class="page-wrapper d-flex align-items-center justify-content-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="logo">
                                <h2 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">TABUNGAN SEKOLAH</h2>
                                    <br>
                                <img style="width: 250px" height="250px" src="{{ asset('template-admin/src/assets/images/logos/icon.png') }}"
                                    alt="Icon">
                            </div>
                            <h4 class="text-center mb-4">Silahkan Login Terlebih Dahulu!</h4>
                            <form action="{{ route('login.post') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        value="{{ old('email', request()->cookie('remember_email')) }}"
                                        aria-describedby="emailHelp">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" required>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3 d-flex justify-content-between">
                                    <div class="remember-me">
                                        <input type="checkbox" id="remember" name="remember">
                                        <label for="remember">Ingat Saya</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2 rounded-3">Masuk</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('template-admin/src/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('template-admin/src/assets/js/scripts.js') }}"></script>
    <script>
        @if (session('loginError'))
            swal('Login Gagal', '{{ session('loginError') }}', 'error');
        @endif
    </script>
</body>

</html>