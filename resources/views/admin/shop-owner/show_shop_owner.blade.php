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
                        <li class="breadcrumb-item active">Shop Owner</li>
                    </ol>
                </nav>
                <div class=" d-flex justify-content-between align-items-center">
                    <h1 class="h3 m-0">Shop Owner </h1>
                </div>
            </div>
            <div class="col-12">
                <a class="btn btn-secondary backbtn" href="{{ url()->previous() }}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-5 shadow-sm">
                <div class="card-body">
                    <h2 class="h5 mb-4">Owner Details</h2>
                    <div class="list-unstyled">
                        <div class="row mb-3">
                            <dt class="col-lg-3">Name:</dt>
                            <dd class="col-lg-9 text-muted"> {{ $shopOwnerDetails->name ?? 'N/A' }}
                            </dd>
                        </div>
                        <div class="row mb-3">
                            <dt class="col-lg-3">Shop-Name:</dt>
                            <dd class="col-lg-9 text-muted">{{ $shopOwnerDetails->shop_name ?? 'N/A' }}</dd>
                        </div>
                        <div class="row mb-3">
                            <dt class="col-lg-3">Shop-Email:</dt>
                            <dd class="col-lg-9 text-muted">{{ $shopOwnerDetails->email ?? 'N/A' }}</dd>
                        </div>
                        <div class="row mb-3">
                            <dt class="col-lg-3">Shop-Address:</dt>
                            <dd class="col-lg-9 text-muted">{{ $shopOwnerDetails->address ?? 'N/A' }}</dd>
                        </div>
                        <div class="row mb-3">
                            <dt class="col-lg-3">Shop-Phone:</dt>
                            <dd class="col-lg-9 text-muted">{{ $shopOwnerDetails->phone ?? 'N/A' }}</dd>
                        </div>
                        <div class="row mb-3">
                            <dt class="col-lg-3">Shop-Name:</dt>
                            <dd class="col-lg-9 text-muted">{{ $shopOwnerDetails->shop_name ?? 'N/A' }}</dd>
                        </div>
                        <div class="row mb-3">
                            <dt class="col-lg-3">Domain:</dt>
                            <dd class="col-lg-9 text-muted">{{ $shopOwnerDetails->domain ?? 'N/A' }}</dd>
                        </div>
                        <div class="row mb-3">
                            <dt class="col-lg-3">Package Name:</dt>
                            <dd class="col-lg-9 text-muted">{{ $shopOwnerDetails->package->name ?? 'N/A' }}</dd>
                        </div>
                        <div class="row mb-3">
                            <dt class="col-lg-3">Status:</dt>
                            <dd class="col-lg-9">
                                @if($shopOwnerDetails->status == 'active')
                                 <span class="badge bg-success">Active</span>
                                 @elseif ($shopOwnerDetails->status == 'inactive')
                                 <span class="badge bg-danger">Inactive</span>
                                @endif
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection