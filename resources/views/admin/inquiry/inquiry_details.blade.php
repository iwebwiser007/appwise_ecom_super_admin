@extends('components.admin.layouts')

@section('content')
    <div class="container">
        <div class="py-5">
            <div class="row g-4 align-items-center">
                <div class="col-12">
                <nav class="mb-2" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-sa-simple">
            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
            <span>&nbsp;/&nbsp;</span>
            <li class="breadcrumb-item active">Inquiries</li>
          </ol>
        </nav>
                    
                    <h1 class="h3 m-0">Inquiries</h1>
                </div>
                <div class="col-12">
                    <a class="btn btn-secondary backbtn" href="{{ url()->previous() }}">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if (Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> {{ Session::get('error_message') }}
                <button type="button" class="sa-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="sa-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success:</strong> {{ Session::get('success_message') }}
                <button type="button" class="sa-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Customer and Return Details -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-5 shadow-sm">
                    <div class="card-body">
                        <h2 class="h5 mb-4">Inquiry Details</h2>
                        <div class="list-unstyled">
                            <div class="row mb-3">
                                <dt class="col-lg-3">User Name:</dt>
                                <dd class="col-lg-9 text-muted">{{ $inquiry_detail['name'] }}</dd>
                            </div>
                            <div class="row mb-3">
                                <dt class="col-lg-3">Email:</dt>
                                <dd class="col-lg-9 text-muted">{{ $inquiry_detail['email'] ?? 'N/A' }}</dd>
                            </div>
                            <div class="row mb-3">
                                <dt class="col-lg-3">Mobile:</dt>
                                <dd class="col-lg-9 text-muted">{{ $inquiry_detail['phone'] ?? 'N/A' }}</dd>
                            </div>
                            <div class="row mb-3">
                                <dt class="col-lg-3">Address:</dt>
                                <dd class="col-lg-9 text-muted">{{ $inquiry_detail['address'] ?? 'N/A' }}</dd>
                            </div>
                            <div class="row mb-3">
                                <dt class="col-lg-3">Message:</dt>
                                <dd class="col-lg-9 text-muted">{{ $inquiry_detail['message'] ?? 'N/A' }}</dd>
                            </div>
                            <!-- <div class="row mb-3">
                                <dt class="col-lg-3">Status:</dt>
                                <dd class="col-lg-9 text-muted">{{ $inquiry_detail['status'] ?? 'N/A' }}</dd>
                            </div> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
