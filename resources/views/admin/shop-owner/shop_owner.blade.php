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
                    @can('create owner')
                    <a href="{{ route('admin.addEditShopOwner') }}" class="btn btn-primary">New Create</a>
                    @endcan
                </div>

                @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <strong>Success:</strong> {{ Session::get('success_message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                    <input type="text" placeholder="Start typing to search for Shop Owners"
                        class="form-control form-control--search mx-auto" id="table-search" />
                </div>
                <div class="sa-divider"></div>
                <table class="sa-datatables-init" data-order="[[ 0, &quot;desc&quot; ]]" data-sa-search-input="#table-search">
                    <thead class="sticky-header">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Shop Name</th>
                            <th>Shop Email</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Domain</th>
                            <th>Package</th>
                            <!-- <th>Start Date</th>
                            <th>End Date </th> -->
                            <th>Status</th>
                            @if (Gate::check('edit owner') || Gate::check('delete owner'))
                            <th>Actions</th>
                            @endif
                            <!-- <th>Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($shopOwners as $shopOwner)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $shopOwner->name ?? 'N/A' }}</td>
                            <td>{{ $shopOwner->shop_name ?? 'N/A' }}</td>
                            <td>{{ $shopOwner->email ?? 'N/A' }}</td>
                            <td>{{ $shopOwner->phone ?? 'N/A' }}</td>
                            <td>{{ $shopOwner->address ?? 'N/A' }}</td>
                            <td>{{ $shopOwner->domain ?? 'N/A' }}</td>
                            <td>{{ $shopOwner->package->name ?? 'No Package' }}</td>
                            <!-- <td>{{ $shopOwner->start_date ?? 'N/A' }}</td>
                            <td>{{ $shopOwner->end_date ?? 'N/A' }}</td> -->

                            <td>
                                @if ($shopOwner->status == 'active')
                                <span class="badge bg-success @can('owner status') change-status @endcan" data-id="{{ $shopOwner->id }}"
                                    data-status="active">Active</span>
                                @elseif ($shopOwner->status == 'inactive')
                                <span class="badge bg-danger @can('owner status') change-status @endcan" data-id="{{ $shopOwner->id }}"
                                    data-status="inactive">Inactive</span>
                                @endif
                                {{--@if ($shopOwner->status == 'active' && (!$shopOwner->end_date || now() <= $shopOwner->end_date))
                                    <span class="badge bg-success @can('owner status') change-status @endcan"
                                        data-id="{{ $shopOwner->id }}" data-status="active">Active</span>
                                @elseif ($shopOwner->status == 'inactive' && (!$shopOwner->end_date || now() <= $shopOwner->
                                    end_date))
                                    <span class="badge bg-danger @can('owner status') change-status @endcan"
                                        data-id="{{ $shopOwner->id }}" data-status="inactive">Inactive</span>
                                    @elseif ($shopOwner->end_date && now() > $shopOwner->end_date)
                                    <span class="badge bg-dark">Suspended</span>
                                    @endif
                                    --}}
                            </td>
                            @if (Gate::check('edit owner') || Gate::check('delete owner'))
                            <td>
                                <div class="d-flex gap-3">
                                    @can('edit owner')
                                    <a href="{{ route('admin.addEditShopOwner', $shopOwner->id) }}" class="actionbtn-tb actionbtn-edit"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit">
                                        <i class="far fa-edit text-white"></i>
                                    </a>
                                    @endcan
                                    @can('delete owner')
                                    <a href="#" data-url="{{ route('admin.delete', ['type' => 'owner', 'id' => $shopOwner->id] ) }}"
                                        class="actionbtn-tb actionbtn-remove delete-btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    @endcan
                                    <a href="{{ url('admin/shop-owners-details/' . $shopOwner->id) }}" class="actionbtn-tb actionbtn-edit"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="View">
                                        <i class="far fa-eye text-white"></i>
                                    </a>
                                </div>
                            </td>
                            @endif
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