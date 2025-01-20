@extends('components.admin.layouts')
<!-- Bootstrap Icons CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


@section('content')
<div class="container">
    <div class="py-5">
        <div class="row g-4 align-items-center">
            <div class="col">
                <nav class="mb-2" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-sa-simple">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <span class="breadcrumb-item">/</span>
                        <li class="breadcrumb-item active">Admin Settings</li>
                    </ol>
                </nav>
                <h1 class="h3 m-0">Admin Settings {{-- meaning Product images --}}</h1>
            </div>
        </div>
    </div>

    <div class="mb-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">


                        {{-- Our Bootstrap error code in case of wrong current password or the new password and confirm password are not matching: --}}
                        {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                        @if (Session::has('error_message'))
                        <!-- Check AdminController.php, updateAdminPassword() method -->
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error:</strong> {{ Session::get('error_message') }}
                            <button type="button" class="sa-close" data-bs-dismiss="alert" aria-label="Close">

                            </button>
                        </div>
                        @endif



                        {{-- Displaying The Validation Errors: https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors AND https://laravel.com/docs/9.x/blade#validation-errors --}}
                        {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                        {{-- Our Bootstrap success message in case of updating admin password is successful: --}}
                        @if (Session::has('success_message'))
                        <!-- Check AdminController.php, updateAdminPassword() method -->
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session::get('success_message') }}
                            <button type="button" class="sa-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                        @endif

                        <div class="mb-5">
                            <h2 class="mb-0 fs-exact-18">Update Admin Password</h2>
                        </div>


                        <form class="forms-sample" action="{{ url('admin/update-admin-password') }}" method="post">
                            @csrf


                            <div class="mb-4 d-none">
                                <label class="form-label">Admin Username/Email</label>
                                <input class="form-control" value="{{ $adminDetails['email'] }}" readonly>
                                <!-- Check updateAdminPassword() method in AdminController.php -->
                            </div>
                            <div class="mb-4 d-none">
                                <label class="form-label">Admin Type</label>
                                <input class="form-control" value="{{ $adminDetails['type'] }}" readonly>
                            </div>
                            <div class="mb-4 position-relative">
                                <label class="form-label" for="current_password">Current Password</label>
                                <input type="password" class="form-control" id="current_password" placeholder="Enter Current Password"
                                    name="current_password" required>
                                <p id="check_password"></p>

                                <!-- Eye icon button to toggle password visibility -->
                                <span class="eyebtn" id="eye-toggle">
                                    <i class="bi bi-eye" id="current-toggles-password"></i>
                                </span>
                            </div>




                            <div class="mb-4 position-relative">
                                <label class="form-label" for="new_password">New Password</label>
                                <input type="password" class="form-control" id="new_password" placeholder="Enter New Password"
                                    name="new_password" required>

                                <!-- Eye icon button to toggle password visibility -->
                                <span class="eyebtn" id="eye-toggle-new">
                                    <i class="bi bi-eye" id="new-toggles-password"></i>
                                </span>
                            </div>

                            <div class="mb-4 position-relative">
                                <label class="form-label" for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password"
                                    name="confirm_password" required>

                                <!-- Eye icon button to toggle password visibility -->
                                <span class="eyebtn" id="eye-toggle-confirm">
                                    <i class="bi bi-eye" id="confirm-toggles-password"></i>
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
{{-- @include('admin.layout.footer') --}}
<!-- partial -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // For current password field
        const currentPasswordField = document.getElementById('current_password');
        const currentToggleIcon = document.getElementById('current-toggles-password');

        currentToggleIcon.addEventListener('click', function() {
            if (currentPasswordField.type === 'password') {
                currentPasswordField.type = 'text'; // Show password
                currentToggleIcon.classList.remove('bi-eye');
                currentToggleIcon.classList.add('bi-eye-slash');
            } else {
                currentPasswordField.type = 'password'; // Hide password
                currentToggleIcon.classList.remove('bi-eye-slash');
                currentToggleIcon.classList.add('bi-eye');
            }
        });

        // For new password field
        const newPasswordField = document.getElementById('new_password');
        const newToggleIcon = document.getElementById('new-toggles-password');

        newToggleIcon.addEventListener('click', function() {
            if (newPasswordField.type === 'password') {
                newPasswordField.type = 'text'; // Show password
                newToggleIcon.classList.remove('bi-eye');
                newToggleIcon.classList.add('bi-eye-slash');
            } else {
                newPasswordField.type = 'password'; // Hide password
                newToggleIcon.classList.remove('bi-eye-slash');
                newToggleIcon.classList.add('bi-eye');
            }
        });

        // For confirm password field
        const confirmPasswordField = document.getElementById('confirm_password');
        const confirmToggleIcon = document.getElementById('confirm-toggles-password');

        confirmToggleIcon.addEventListener('click', function() {
            if (confirmPasswordField.type === 'password') {
                confirmPasswordField.type = 'text'; // Show password
                confirmToggleIcon.classList.remove('bi-eye');
                confirmToggleIcon.classList.add('bi-eye-slash');
            } else {
                confirmPasswordField.type = 'password'; // Hide password
                confirmToggleIcon.classList.remove('bi-eye-slash');
                confirmToggleIcon.classList.add('bi-eye');
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        // Check if the Admin Password is correct using AJAX in update_admin_password.blade.php page
        $("#current_password").keyup(function() {
            // console.log(this);
            var current_password = $(this).val();

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                }, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token
                type: "post",
                url: "{{ url('admin/check-admin-password') }}",
                // url: "/admin/check-admin-password", // check the web.php for this route and check the AdminController for the checkAdminPassword() method
                data: {
                    current_password: current_password
                }, // A key/value pair that will checked inside the AdminController using Hash::check($data['current_password']) (e.g. current_password: 123456)    // send the the    var current_password    (Check the above variable)
                success: function(resp) {
                    // alert(resp);
                    if (resp == "false") {
                        $("#check_password").html(
                            '<b style="color: red">Current Password is Incorrect!</b>'
                        ); // the <span> element in update_admin_password.blade.php
                    } else if (resp == "true") {
                        $("#check_password").html(
                            '<b style="color: green">Current Password is Correct!</b>'
                        ); // the <span> element in update_admin_password.blade.php
                    }
                },
                error: function() {
                    alert("Error");
                },
            });
        });
    });
</script>
@endsection

