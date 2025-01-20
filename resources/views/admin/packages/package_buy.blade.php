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
                        <li class="breadcrumb-item active">Packages Purchase</li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between">
                    <h1 class="h3 m-0">Packages Purchase</h1>
                    <div class="d-flex align-items-center ">
                        <button class="btn btn-primary me-3" type="button" data-toggle="collapse" data-target="#filter-section"
                            aria-expanded="false" aria-controls="filter-section">Filter</button>
                        <form action="{{ url('admin/package_buy') }}" method="POST" class="d-inline-block">
                            @csrf
                            <input type="hidden" name="type" value="export">
                            <input type="hidden" name="package_purchases" value="{{ json_encode($packageBuy) }}">
                            <button type="submit" class="btn btn-success">Export</button>
                        </form>
                    </div>
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

    <div id="filter-section" class="collapse row mb-4">
        <div class="col-lg-8">
            <form action="{{ url('admin/package_buy') }}" method="post" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <input type="date" name="start_date" class="form-control" placeholder="Start Date"
                        value="{{ request('start_date') }}">
                </div>
                <div class="col-md-4">
                    <input type="date" name="end_date" class="form-control" placeholder="End Date"
                        value="{{ request('end_date') }}">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-200">Apply</button>
                </div>
            </form>
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
                            <th>Shop-Owner Name</th>
                            <th>Package Name</th>
                            <th>Number Of Section</th>
                            <th>Number Of Category</th>
                            <th>Number Of Product</th>
                            <th>Price</th>
                            <th>Days</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $i = 1;
                        @endphp
                        @foreach ($packageBuy as $package)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                <a class="text-black" href="{{url('admin/shop-owners-details/' . $package->shopowner->id)}}">
                                    {{ $package->shopowner->name }}
                                </a>
                            </td>
                            <td>{{ $package->package_name }}</td>
                            <td>{{ $package->number_of_section }}</td>
                            <td>{{ $package->number_of_category }}</td>
                            <td>{{ $package->number_of_product }}</td>
                            <td>{{ $package->price }}</td>
                            <td>{{ $package->days }}</td>
                            <td>
                                @if($package->status == 'active')
                                <span class="badge bg-success " data-id="
                                    {{ $package->id }}" data-status="active">Active</span>
                                @elseif($package->status == 'inactive')
                                <span class="badge bg-danger " data-id="
                                    {{ $package->id }}" data-status="inactive">Inactive</span>
                                @else
                                <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('admin/edit_package_buy/' . $package->id) }}" class="actionbtn-tb actionbtn-edit"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit"><i
                                        class="far fa-edit text-white"></i></a>
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
    var packageId, currentStatus;

    $(document).on('click', '.change-status', function() {
        packageId = $(this).data('id');
        currentStatus = $(this).data('status');
        $('#statusChangeModal').modal('show');
    });


    $("#confirmStatusChange").click(function() {
        var newStatus = currentStatus == "active" ? "inactive" : "active";
        $.ajax({
            url: "{{ url('admin/change-package_buy-status') }}",
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

<script>
    $(document).ready(function() {
        // Filter Section Toggle
        $('[data-toggle="collapse"]').on('click', function() {
            $('#filter-section').collapse('toggle');
        });

        // Form Auto-submit on Input Change
        const filterForm = document.querySelector('form');
        const statusSelect = document.getElementById('status');
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');

        function submitFormIfChanged(event) {
            filterForm.submit();
        }


        if (statusSelect) {
            statusSelect.addEventListener('change', submitFormIfChanged);
        }
        if (startDateInput) {
            startDateInput.addEventListener('change', submitFormIfChanged);
        }
        if (endDateInput) {
            endDateInput.addEventListener('change', submitFormIfChanged);
        }
    });
</script>
@endsection