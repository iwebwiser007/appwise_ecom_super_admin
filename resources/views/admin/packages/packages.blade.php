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
            <li class="breadcrumb-item active">Packages</li>
          </ol>
        </nav>
        @can('create package')
        <div class="d-flex justify-content-between">
          <h1 class="h3 m-0">Packages</h1>
          <a href="{{ url('admin/add-edit-package') }}" class="btn btn-primary">New Create</a>
        </div>
        @endcan
        @if (Session::has('success_message'))
        <!-- Check AdminController.php, updateAdminPassword() method -->
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
          <strong>Success:</strong> {{ Session::get('success_message') }}
          <button type="button" class="sa-close" data-bs-dismiss="alert" aria-label="Close">

          </button>
        </div>
        @endif
      </div>
      <div class="col-12">
        <a class="btn btn-secondary backbtn" href="{{ url()->previous() }}">
          <i class="fa fa-arrow-left" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="p-4">
          <input type="text" placeholder="Start typing to search for Brands"
            class="form-control form-control--search mx-auto" id="table-search" />
        </div>
        <div class="sa-divider"></div>
        <table class="sa-datatables-init" data-order="[[ 0, &quot;desc&quot; ]]" data-sa-search-input="#table-search">
          <thead class="sticky-header">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Description</th>
              <th>Number Of Section</th>
              <th>Number Of Category</th>
              <th>Number Of Product</th>
              <th>Price</th>
              <th>Days</th>
              <th>Status</th>
              @if (Gate::check('edit package') || Gate::check('delete package'))
              <th>Actions</th>
              @endif
              <!-- <th>Actions</th> -->
            </tr>
          </thead>
          <tbody>
            @php
            $i = 1;
            @endphp
            @forelse ($packages as $package)
            <tr>
              <td>{{$i}}</td>
              <td>{{ $package['name'] ?? "N/A"}}</td>
              <td>{{ $package['description'] ?? "N/A"}}</td>
              <td>{{ $package['number_of_section'] ?? "N/A"}}</td>
              <td>{{ $package['number_of_category'] ?? "N/A"}}</td>
              <td>{{ $package['number_of_product'] ?? "N/A"}}</td>
              <td>{{ $package['price'] ?? "N/A"}}</td>
              <td>{{ $package['days'] ?? "N/A"}}</td>
              <td>
                @if($package['status'] == 'Active')
                <span class="badge bg-success @can('package status') change-status @endcan"
                  data-id="{{ $package['id'] }}" data-status="Active">Active</span>
                @elseif($package['status'] == 'Inactive')
                <span class="badge bg-danger change-status" data-id="{{ $package['id'] }}"
                  data-status="Inactive">Inactive</span>
                @else
                <span class="badge bg-secondary">N/A</span>
                @endif
              </td>
              @if (Gate::check('edit package') || Gate::check('delete package'))
              <td>
                <div class="d-flex gap-3">
                  @can('edit package')
                  <a href="{{ url('admin/add-edit-package/' . $package['id']) }}" class="actionbtn-tb actionbtn-edit"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit"><i
                      class="far fa-edit text-white"></i></a>
                  @endcan
                  @can('delete package')
                  <a href="#" data-url="{{ route('admin.delete', ['type' => 'package', 'id' => $package['id']]) }}"
                    class="actionbtn-tb actionbtn-remove delete-btn" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-original-title="Delete">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                  @endcan
                </div>
              </td>
              @endif
            </tr>
            @php
            $i = $i + 1;
            @endphp
            @empty

            @endforelse
            {{-- <tr>
                                    <td>
                                        <div class="d-flex align-items-center"><a href="#" class="me-4">
                                                <div class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                                                    <img src="{{ asset('public/admin/images/products/product-1-40x40.jpg') }}"
            width="40" height="40" alt="" />
      </div>
      </a>
      <div><a href="#" class="text-reset">Undefined Tool
          IRadix DPS300SY 2700 Watts</a>
        <div class="sa-meta mt-0">
          <ul class="sa-meta__list">
            <li class="sa-meta__item">ID: <span title="Click to copy product ID" class="st-copy">1746</span>
            </li>
            <li class="sa-meta__item">SKU: <span title="Click to copy product SKU" class="st-copy">DPS300SY</span></li>
          </ul>
        </div>
      </div>
    </div>
    </td>
    <td><a href="#" class="text-reset">Power Tools</a></td>
    <td>
      <div class="badge badge-sa-danger">Out of Stock</div>
    </td>
    <td>
      <div class="sa-price"><span class="sa-price__symbol">$</span><span class="sa-price__integer">1,019</span><span
          class="sa-price__decimal">.00</span>
      </div>
    </td>
    <td>
      <div class="d-flex gap-3">
        <a href="#" class="actionbtn-tb actionbtn-edit"><i class="far fa-edit text-white"></i></a>
        <a href="#" class="actionbtn-tb actionbtn-img"><i class="far fa-images"></i></a>
        <a href="#" class="actionbtn-tb actionbtn-add"><i class="fas fa-plus"></i></a>
        <a href="#" class="actionbtn-tb actionbtn-remove"><i class="fas fa-trash-alt"></i></a>
      </div>
    </td>
    </tr> --}}
    </tbody>
    </table>
  </div>
</div>
</div>
</div>

@endsection

@section('scripts')
<script>
var packageId, currentStatus;

$(document).on('click', '.change-status', function() {
  packageId = $(this).data('id');
  currentStatus = $(this).data('status');
  $('#statusChangeModal').modal('show');
});

$("#confirmStatusChange").click(function() {
  var newStatus = currentStatus == "Active" ? "Inactive" : "Active";
  $.ajax({
    url: "{{ url('admin/change-package-status') }}",
    type: "POST",
    data: {
      _token: "{{ csrf_token() }}",
      package_id: packageId,
      status: newStatus,
    },
    success: function(response) {
      console.log("AJAX request successful");
      if (response.success) {
        console.log("Status changed successfully");
        location.reload();
      } else {
        console.log("Status change failed");
        alert("Something went wrong. Please try again.");
      }
    },
    error: function(xhr, status, error) {
      console.log("AJAX request failed: " + error);
    },
  });
});
</script>
@endsection
