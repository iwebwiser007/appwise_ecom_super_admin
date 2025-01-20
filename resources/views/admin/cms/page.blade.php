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
            <li class="breadcrumb-item active">Page</li>
          </ol>
        </nav>
        <div class="d-flex justify-content-between">
          <h1 class="h3 m-0">Pages</h1>
          @can('create page')
          <a href="{{ url('admin/add-edit-page') }}" class="btn btn-primary">New Create</a>
          @endcan
        </div>
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
              <th>page title</th>
              <!-- <th>url key</th> -->
              <th>Status</th>
              @can('edit page')
              <th>Actions</th>
              @endcan
            </tr>
          </thead>
          <tbody>
            @php
            $i = 1;
            @endphp
            @forelse ($pages as $page)
            <tr>
              <td>{{ $i }}</td>
              <td>{{ $page['page_title'] ?? "N/A"}}</td>
              {{--<td>
                                {{ $page['url_key'] }}
              </td>--}}
              <td>
                @if($page['status'] == '1')
                <span class="badge bg-success change-status" data-id="{{ $page['id'] }}" data-status="1">Active</span>
                @elseif($page['status'] == '0')
                <span class="badge bg-danger change-status" data-id="{{ $page['id'] }}" data-status="0">Inactive</span>
                @else
                <span class="badge bg-secondary">N/A</span>
                @endif
              </td>
              @can('edit page')
              <td>
                <div class="d-flex gap-3">
                  <a href="{{ url('admin/add-edit-page/' . $page['id']) }}" class="actionbtn-tb actionbtn-edit"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit"><i
                      class="far fa-edit text-white"></i></a>

                  <a href="#" data-url="{{ route('admin.delete', ['type' => 'page', 'id' => $page['id']]) }}"
                    class="actionbtn-tb actionbtn-remove delete-btn d-none" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-original-title="Delete">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                </div>

              </td>
              @endcan
            </tr>
            @php
            $i = $i + 1;
            @endphp
            @empty
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
var pageId, currentStatus;

$(document).on('click', '.change-status', function() {
  pageId = $(this).data('id');
  currentStatus = $(this).data('status');
  $('#statusChangeModal').modal('show');
});

$("#confirmStatusChange").click(function() {
  var newStatus = currentStatus == "1" ? "0" : "1";
  $.ajax({
    url: "{{ url('admin/change-page-status') }}",
    type: "POST",
    data: {
      _token: "{{ csrf_token() }}",
      page_id: pageId,
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
