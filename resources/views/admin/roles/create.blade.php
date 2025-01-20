@extends('components.admin.layouts')
@section('content')
<div class="container">
    <div class="py-5">
        <div class="row g-4 align-items-center">
            <div class="col-12">
                <nav class="mb-2" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-sa-simple">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <span>&nbsp;/&nbsp;</span>
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                      </ol>
                </nav>
                <div class="mb-3">
                    <h1 class="h3 m-0">Role</h1>
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

                        <form action="{{ route('roles.store') }}" method="post" data-parsley-validate>
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label" for="name">Role Name <span class="text-danger">
                                        *</span></label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter Role Name" name="name"
                                            value="{{ old('name') }}" data-parsley-required="true">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label">Assign Permissions</label>
                                        <div class="row">

                                        <div class="col-12 mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" id="selectAll" class="form-check-input">
                                                    <label for="selectAll" class="form-check-label">Select All</label>
                                                </div>
                                            </div>

                                            @forelse($permissions as $permission)
                                            <div class="col-sm-6 col-12 col-lg-3 mb-2">
                                                <div class="form-check">
                                                    <input type="checkbox" name="permission[]" id="permission-{{ $permission->id }}"
                                                        value="{{ $permission->name }}" class="form-check-input permission-checkbox">
                                                    <label for="permission-{{ $permission->id }}"
                                                        class="form-check-label">{{ $permission->name }}</label>
                                                </div>
                                            </div>
                                            @empty
                                            <p class="text-muted">No permissions available.</p>
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

@endsection

@section('scripts')
<script>
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.permission-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>
@endsection