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
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </nav>
                <div class=" d-flex justify-content-between align-items-center">
                    <h1 class="h3 m-0">Profile</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-8">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="mb-5">
                        <h2 class="mb-0 fs-exact-18">Personal Information</h2>
                    </div>

                    <div class="list-unstyled row">
                        <dt class="list-unstyled m-0 col-sm-3">Email: </dt>
                        <dd class="fs-exact-13 text-muted mb-0 mt-1 col-sm-9">
                            {{ $user->email ?? 'N/A' }}
                        </dd>
                    </div>
                    <!-- Check updateAdminPassword() method in AdminController.php -->
                    <div class="list-unstyled row">
                        <dt class="list-unstyled m-0 col-sm-3">Name: </dt>
                        <dd class="fs-exact-13 text-muted mb-0 mt-1 col-sm-9">
                            {{ $user->name ?? 'N/A' }}
                        </dd>
                    </div>

                    <div class="list-unstyled row">
                        <dt class="list-unstyled m-0 col-sm-3">Mobile: </dt>
                        <dd class="fs-exact-13 text-muted mb-0 mt-1 col-sm-9">
                            {{ $user->mobile ?? 'N/A' }}
                        </dd>
                    </div>

                    <div class="list-unstyled row">
                        <dt class="list-unstyled m-0 col-sm-3">Address: </dt>
                        <dd class="fs-exact-13 text-muted mb-0 mt-1 col-sm-9">
                            {{ $user->address ?? 'N/A' }}
                        </dd>
                    </div>

                    <div class="list-unstyled row">
                        <dt class="list-unstyled m-0 col-sm-3">Country: </dt>
                        <dd class="fs-exact-13 text-muted mb-0 mt-1 col-sm-9">
                            {{ $user->country ?? 'N/A' }}
                        </dd>
                    </div>

                    <div class="list-unstyled row">
                        <dt class="list-unstyled m-0 col-sm-3">State: </dt>
                        <dd class="fs-exact-13 text-muted mb-0 mt-1 col-sm-9">
                            {{ $user->state ?? 'N/A' }}
                        </dd>
                    </div>

                    <div class="list-unstyled row">
                        <dt class="list-unstyled m-0 col-sm-3">City: </dt>
                        <dd class="fs-exact-13 text-muted mb-0 mt-1 col-sm-9">
                            {{ $user->city ?? 'N/A' }}
                        </dd>
                    </div>

                    <div class="list-unstyled row">
                        <dt class="list-unstyled m-0 col-sm-3">Postal Code: </dt>
                        <dd class="fs-exact-13 text-muted mb-0 mt-1 col-sm-9">
                            {{ $user->postal_code ?? 'N/A' }}
                        </dd>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection