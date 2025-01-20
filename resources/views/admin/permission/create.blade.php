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
            <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permissions</a></li>
            
          </ol>
        </nav>
        <div class="mb-3">
          <h1 class="h3 m-0">Permission</h1>
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
      <div class="col-12 col-lg-6">
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

            <form action="{{ route('permissions.store') }}" method="post" data-parsley-validate>
              @csrf
              <div class="mb-4">
                <label class="form-label" for="name">Permission Name <span class="text-danger">
                *</span></label>
                <input type="text" class="form-control" id="name" placeholder="Enter Permission Name" name="name"
                  value="{{ old('name') }}" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
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