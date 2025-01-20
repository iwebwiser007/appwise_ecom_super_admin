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
                        <li class="breadcrumb-item active">Business Owners</li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between">
                    <h1 class="h3 m-0">Business Owners</h1>
                </div>

                @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <strong>Success:</strong> {{ Session::get('success_message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> {{ Session::get('error_message') }}
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

    <!-- Shop Owners Table -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="p-4">
                    <input type="text" placeholder="Start typing to search for Business Owners"
                        class="form-control form-control--search mx-auto" id="table-search" />
                </div>
                <div class="sa-divider"></div>
                <table class="sa-datatables-init" data-order="[[ 0, &quot;desc&quot; ]]" data-sa-search-input="#table-search">
                    <thead class="sticky-header">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Shop Name</th>
                            <th>Domain</th>
                            <th>Package</th>
                            <!-- <th>Start Date</th>
                            <th>End Date </th> -->
                            <th>Actions</th>
                            <!-- <th>Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $i =  1;
                        @endphp
                        @foreach ($shopOwners as $shopOwner)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $shopOwner->name ?? 'N/A' }}</td>
                            <td>{{ $shopOwner->shop_name ?? 'N/A' }}</td>
                            <td>{{ $shopOwner->domain ?? 'N/A' }}</td>
                            <td>{{ $shopOwner->package->name ?? 'No Package' }}</td>
                            {{--<td>{{ $shopOwner->start_date ?? 'N/A' }}</td>
                            <td>{{ $shopOwner->end_date ?? 'N/A' }}</td>--}}
                            <td>
                                <div class="d-flex gap-3">
                                    <a href="{{ url('admin/shop-sales-report/' . $shopOwner->id) }}" class="actionbtn-tb actionbtn-edit"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="View Report">
                                        <i class="far fa-file-alt text-white"></i> <!-- Report icon -->
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @php
                        $i = $i + 1;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    var ownerId, currentStatus;

    $(document).on('click', '.change-status', function() {
        ownerId = $(this).data('id');
        currentStatus = $(this).data('status');
        $('#statusChangeModal').modal('show');
    });

    $("#confirmStatusChange").click(function() {
        var newStatus = currentStatus == "active" ? "inactive" : "active";
        $.ajax({
            url: "{{ url('admin/change-owner-status') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                owner_id: ownerId,
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