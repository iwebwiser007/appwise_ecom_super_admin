@extends('components.admin.layouts')

@section('content')
<div class="container">
    <div class="py-5">
        <div class="row g-4 align-items-center">
            <div class="col">
                <nav class="mb-2" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-sa-simple">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <span>&nbsp;/&nbsp;</span>
                        <li class="breadcrumb-item"><a href="{{ route('admin.shopOwners') }}">Business Owner</a></li>
                    </ol>
                </nav>
                <h1 class="h3 m-0"> Business Owner</h1>
            </div>
            <div class="col-12">
                <a class="btn btn-secondary backbtn" href="{{ url()->previous() }}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Success or Error Alerts -->
    <div class="mb-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if (Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error:</strong> {{ Session::get('error_message') }}
                            <button type="button" class="sa-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if (Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session::get('success_message') }}
                            <button type="button" class="sa-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <!-- Form for Add/Edit Shop Owner -->
                        <form
                            action="{{ $shopOwner ? route('admin.addEditShopOwner', $shopOwner->id) : route('admin.addEditShopOwner') }}"
                            method="POST" data-parsley-validate>
                            @csrf
                            <div class="row">
                                <!-- Left Column: Shop Owner Details -->
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="name" class="form-label">Name <span class="text-danger">
                                                *</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Name"
                                            value="{{ old('name', $shopOwner->name ?? '') }}" required>
                                    </div>

                                    <div class="mb-4">
                                        <label for="shop_name" class="form-label">Shop Name <span class="text-danger">
                                                *</span></label>
                                        <input type="text" class="form-control" name="shop_name" placeholder="Enter Shop Name"
                                            value="{{ old('shop_name', $shopOwner->shop_name ?? '') }}" required>
                                    </div>

                                    <div class="mb-4">
                                        <label for="email" class="form-label">Shop Email <span class="text-danger">
                                                *</span></label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter Your Shop Email"
                                            value="{{ old('email', $shopOwner->email ?? '') }}" required>
                                    </div>

                                    <div class="mb-4">
                                        <label for="address" class="form-label">Shop Address <span class="text-danger">
                                                *</span></label>
                                        <input type="text" class="form-control" name="address" placeholder="Enter Your Shop Address"
                                            value="{{ old('address', $shopOwner->address ?? '') }}" required>
                                    </div>

                                </div>

                                <!-- Right Column: Package and Status Details -->
                                <div class="col-md-6">


                                    <div class="mb-4">
                                        <label for="phone" class="form-label">Phone <span class="text-danger">
                                                *</span></label>
                                        <input type="text" class="form-control" name="phone" placeholder="Enter Your Phone Number"
                                            value="{{ old('phone', $shopOwner->phone ?? '') }}" data-parsley-required="true"
                                            data-parsley-type="digits" data-parsley-length="[10, 15]"
                                            data-parsley-length-message="Phone number must be between 10 to 15 digits"
                                            data-parsley-trigger="change">
                                    </div>

                                    <div class="mb-4">
                                        <label for="domain" class="form-label">Domain ( www.example.co.za ) </label>
                                        <input type="url" class="form-control" name="domain" placeholder="Enter Your Domain Name"
                                            value="{{ old('domain', $shopOwner->domain ?? '') }}" >
                                    </div>
                                    <div class="mb-4">
                                        <label for="package_id" class="form-label">Package <span class="text-danger">
                                                *</span></label>
                                        <select name="package_id" class="form-control" required>
                                            <option value="">Select Package</option>
                                            @foreach ($packages as $package)
                                            <option value="{{ $package->id }}"
                                                {{ old('package_id', $shopOwner->package_id ?? '') == $package->id ? 'selected' : '' }}>
                                                {{ $package->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-4 d-none">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="active" selected
                                                {{ old('status', $shopOwner->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive"
                                                {{ old('status', $shopOwner->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            <option value="suspended"
                                                {{ old('status', $shopOwner->status ?? '') == 'suspended' ? 'selected' : '' }}>Suspended
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Hidden Input Fields for Start Date and End Date -->
                                    <input type="hidden" name="start_date" value="{{ old('start_date', now()->toDateString()) }}">
                                    <input type="hidden" name="end_date" value="{{ old('end_date', $shopOwner->end_date ?? '') }}">

                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>

                            @if (empty($shopOwner->id))
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection