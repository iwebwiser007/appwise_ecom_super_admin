<!DOCTYPE html>
<html lang="en" dir="ltr" data-scompiler-id="0">
<!-- Mirrored from stroyka-admin.html.themeforest.scompiler.ru/variants/ltr/auth-sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 31 Jul 2024 05:26:07 GMT -->

<head>
    <meta charSet="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="format-detection" content="telephone=no" />
    <title>App Wise</title><!-- icon -->
    <link rel="icon" type="image/png" href="images/favicon.png" /><!-- fonts -->
    <link rel="icon" href="{{ asset('public/admin/images/favicon.ico') }}" type="image/gif/x-icon/png" sizes="16x16">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" />
    <!-- css -->

    <link rel="stylesheet" href="{{ asset('public/admin/vendor/bootstrap/css/bootstrap.ltr.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/vendor/highlight.js/styles/github.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/vendor/simplebar/simplebar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/vendor/quill/quill.snow.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/vendor/air-datepicker/css') }}/datepicker.min.css" />
    <link rel="stylesheet" href="{{ asset('public/admin/vendor/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/vendor/datatables/css/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/vendor/nouislider/nouislider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/vendor/fullcalendar/main.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/parsleycss.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-97489509-8"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-97489509-8');

        document.addEventListener('DOMContentLoaded', function() {
            // For password field
            const passwordField = document.getElementById('password');
            const passwordToggleIcon = document.getElementById('password-toggles-password');

            passwordToggleIcon.addEventListener('click', function() {
                if (passwordField.type === 'password') {
                    passwordField.type = 'text'; // Show password
                    passwordToggleIcon.classList.remove('bi-eye');
                    passwordToggleIcon.classList.add('bi-eye-slash');
                } else {
                    passwordField.type = 'password'; // Hide password
                    passwordToggleIcon.classList.remove('bi-eye-slash');
                    passwordToggleIcon.classList.add('bi-eye');
                }
            });
        });
    </script>
    <style>
        /* Position the eye icon at the end of the input field and center it vertically */
        .eyebtn {
            position: absolute;
            cursor: pointer;
            top: 62%;
            right: 40px;
            /* Adjust the right distance to your liking */
            transform: translateY(-50%);
            /* Vertically center the icon */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border: 0;
            background: 0;
        }

        /* Style for the icon */
        .eyebtn i {
            font-size: 20px;
            /* You can adjust the size */
            line-height: normal;
        }
    </style>
</head>

<body>
    <div class="min-h-100 p-0 p-sm-6 d-flex align-items-stretch">
        <div class="card w-25x flex-grow-1 flex-sm-grow-0 m-sm-auto">
            <div class="card-body p-sm-5 m-sm-3 flex-grow-0">
                <h1 class="mb-0 fs-3">Sign In</h1>
                <div class="fs-exact-14 text-muted mt-2 pt-1 mb-5 pb-2">Log in to your account to continue.</div>
                @if (Session::has('success_message'))
                <!-- Check AdminController.php, updateAdminPassword() method -->
                <div class="mt-5">
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <strong>Success:</strong> {{ Session::get('success_message') }}
                        <button type="button" class="sa-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if ($msg = session('error_message'))
                <div class="text-danger">{{ $msg }}</div>
                @endif
                <form action="{{ url('admin/login') }}" method="post" data-parsley-validate>
                    @csrf
                    <div class="mb-4"><label class="form-label">Email Address</label><input type="email"
                            class="form-control form-control-lg" name="email" id="email" data-parsley-required="true"
                            data-parsley-required-message='Email is required' data-parsley-whitespace="squish"
                            data-parsley-maxlength="250"
                            data-parsley-maxlength-message="Email must not contain more than 250 words" /></div>

                    <div class="mb-4"><label class="form-label">Password</label><input type="password" name="password"
                            id="password" class="form-control form-control-lg" data-parsley-required="true"
                            data-parsley-required-message='Password is required' data-parsley-whitespace="squish"
                            data-parsley-maxlength="250"
                            data-parsley-maxlength-message="Password must not contain more than 250 words" />
                        <span class="eyebtn" id="eye-toggle-password">
                            <i class="bi bi-eye" id="password-toggles-password"></i>
                        </span>
                    </div>
                    <div class="mb-4 row py-2 flex-wrap">
                        <div class="col-auto me-auto"><label class="form-check mb-0"><input type="checkbox"
                                    class="form-check-input" /><span class="form-check-label">Remember me</span></label>
                        </div>
                        <!-- <div class="col-auto d-flex align-items-center">
                        <a href="auth-forgot-password.html">Forgot
                            password?</a></div> -->
                    </div>


                    <div><button type="submit" class="btn btn-primary btn-lg w-100">Sign In</button></div>
            </div>
        </div>
    </div><!-- scripts -->
    <script src="{{ asset('public/admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/highlight.js/highlight.pack.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/air-datepicker/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/air-datepicker/js/i18n/datepicker.en.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/fontawesome/js/all.min.js') }}" data-auto-replace-svg="" async=""></script>
    <script src="{{ asset('public/admin/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/fullcalendar/main.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/stroyka.js') }}"></script>
    <script src="{{ asset('public/admin/js/custom.js') }}"></script>
    <script src="{{ asset('public/admin/js/calendar.js') }}"></script>
    <script src="{{ asset('public/admin/js/demo.js') }}"></script>
    <script src="{{ asset('public/admin/js/demo-chart-js.js') }}"></script>
    <script src="{{ asset('public/admin/js/parsley.min.js') }}"></script>
</body>
<!-- Mirrored from stroyka-admin.html.themeforest.scompiler.ru/variants/ltr/auth-sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 31 Jul 2024 05:26:07 GMT -->

</html>