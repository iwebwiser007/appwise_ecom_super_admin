@extends('components.admin.layouts')

@section('content')
<div class="container">
    <div class="py-5">
        <div class="row g-4 align-items-center">
            <div class="col">
                <nav class="mb-2" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-sa-simple">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <span>&nbsp;/&nbsp;</span>
                        <li class="breadcrumb-item"><a href="{{ url('admin/packages')}}">Packages Listing</a></li>
                        <span>&nbsp;/&nbsp;</span>
                        <li class="breadcrumb-item active">Packages</li>
                    </ol>
                </nav>
                <h1 class="h3 m-0">Packages</h1>
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

                        <div class="mb-5">
                            <h2 class="mb-0 fs-exact-18">{{ $title }}</h2>
                        </div>

                        <form class="forms-sample" @if (empty($package['id'])) action="{{ url('admin/add-edit-package') }}" @else
                            action="{{ url('admin/add-edit-package/' . $package['id']) }}" @endif method="post" data-parsley-validate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label" for="name">Package Name <span class="text-danger">
                                                *</span></label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter Your Package Name" name="name"
                                            @if(!empty($package['name'])) value="{{ $package['name'] }}" @else value="{{ old('name') }}"
                                            @endif data-parsley-required="true">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="number_of_section">Number Of Section <span class="text-danger">
                                                *</span></label>
                                        <input type="number" class="form-control" id="number_of_section"
                                            placeholder="Enter Number of Section" name="number_of_section"
                                            @if(!empty($package['number_of_section'])) value="{{ $package['number_of_section'] }}" @else
                                            value="{{ old('number_of_section') }}" @endif data-parsley-required="true">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="number_of_category">Number Of Category <span class="text-danger">
                                                *</span></label>
                                        <input type="number" class="form-control" id="number_of_category"
                                            placeholder="Enter Number of Category" name="number_of_category"
                                            @if(!empty($package['number_of_category'])) value="{{ $package['number_of_category'] }}" @else
                                            value="{{ old('number_of_category') }}" @endif data-parsley-required="true">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="number_of_product">Number Of Product <span class="text-danger">
                                                *</span></label>
                                        <input type="number" class="form-control" id="number_of_product"
                                            placeholder="Enter Number of Product" name="number_of_product"
                                            @if(!empty($package['number_of_product'])) value="{{ $package['number_of_product'] }}" @else
                                            value="{{ old('number_of_product') }}" @endif data-parsley-required="true">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="price">Price <span class="text-danger">
                                                *</span></label>
                                        <input type="number" class="form-control" id="price" placeholder="Enter Package Price" name="price"
                                            @if (!empty($package['price'])) value="{{ $package['price'] }}" @else value="{{ old('price') }}"
                                            @endif data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">


                                    <div class="mb-4">
                                        <label class="form-label" for="days">Days <span class="text-danger">
                                                *</span></label>
                                        <input type="number" class="form-control" id="days" placeholder="Enter Package Days" name="days"
                                            @if (!empty($package['days'])) value="{{ $package['days'] }}" @else value="{{ old('days') }}"
                                            @endif data-parsley-required="true">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Active" @if(old('status', $package['status'] ?? '' )=='Active' ) selected @endif>Active</option>
                                            <option value="Inactive" @if(old('status', $package['status'] ?? '' )=='Inactive' ) selected @endif>Inactive</option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="description">Package Description <span class="text-danger">
                                                *</span></label>
                                        <textarea name="description" id="description" class="form-control" rows="7"
                                            data-parsley-required="true">{{ old('description', $package['description']) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            @if (empty($package['id']))
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