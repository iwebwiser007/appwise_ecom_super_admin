@extends('components.admin.layouts')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@section('content')
<div class="container">
    <div class="py-5">
        <div class="row g-4 align-items-center">
            <div class="col-12">
                <nav class="mb-2" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-sa-simple">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <span>&nbsp;/&nbsp;</span>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                    </ol>
                </nav>

                <div class="mb-3">
                    <h1 class="h3 m-0">User</h1>
                </div>

            </div>
            <div class="col-12">
                <a class="btn btn-secondary backbtn" href="{{ url()->previous() }}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="mb-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if (Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error:</strong> {{ Session::get('error_message') }}
                            <button type="button" class="sa-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                        @endif

                        @if (Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session::get('success_message') }}
                            <button type="button" class="sa-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                        @endif

                        <form action="{{ route('users.store') }}" method="post" data-parsley-validate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label" for="name">User Name <span class="text-danger">
                                                *</span></label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter User Name" name="name"
                                            value="{{ old('name') }}" required>
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label" for="email">User Email <span class="text-danger">
                                                *</span></label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter User Email" name="email"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4 position-relative">
                                        <label class="form-label" for="password">Password <span class="text-danger">
                                                *</span></label>
                                        <input type="password" class="form-control" id="password" placeholder="Enter Password"
                                            name="password" required>

                                        <span class="eyebtn" id="eye-toggle-new">
                                            <i class="bi bi-eye" id="new-toggles-password"></i>
                                        </span>
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4 position-relative">
                                        <label class="form-label" for="password_confirmation">Confirm Password <span class="text-danger">
                                                *</span></label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            placeholder="Enter Confirm Password" name="password_confirmation" data-parsley-equalto="#password"
                                            data-parsley-required-message="Confirm Password is required"
                                            data-parsley-equalto-message="Passwords do not match">

                                        <span class="eyebtn" id="eye-toggle-confirm">
                                            <i class="bi bi-eye" id="confirm-toggles-password"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label">Assign Roles</label>
                                        <div class="row">
                                            @forelse($roles as $role)
                                            @if($role->name != 'superadmin' )
                                            <div class="col-sm-6 mb-2">
                                                <div class="form-check">
                                                    <input type="checkbox" name="role[]" id="role-{{ $role->id }}" value="{{ $role->name }}"
                                                        class="form-check-input">
                                                    <label for="role-{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                                                </div>
                                            </div>
                                            @endif
                                            @empty
                                            <p class="text-muted">No roles available.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
       

        // For new password field
        const newPasswordField = document.getElementById('password');
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
        const confirmPasswordField = document.getElementById('password_confirmation');
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
@endsection