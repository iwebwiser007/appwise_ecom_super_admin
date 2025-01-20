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
                        <li class="breadcrumb-item active">Business Owner Sales Report</li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 m-0">Business Owner Sales Report</h1>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-primary me-3" type="button" data-toggle="collapse" data-target="#filter-section"
                            aria-expanded="false" aria-controls="filter-section">Filter</button>
                        <form action="{{ url('admin/sales_report/export') }}" method="POST" class="d-inline-block">
                            @csrf
                            <input type="hidden" name="salesData" value="{{ json_encode($salesData) }}">
                            <button type="submit" class="btn btn-success">Export</button>
                        </form>
                    </div>
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

    <div id="filter-section" class="collapse row mb-4">
        <div class="col-lg-8">
            <form action="{{ route('admin.shopSaleReports', $owner_id) }}" method="post" class="row g-3">

                @csrf
                <div class="col-md-4">
                    <input type="date" name="start_date" class="form-control" placeholder="Start Date"
                        value="{{ request('start_date') }}">
                </div>
                <div class="col-md-4">
                    <input type="date" name="end_date" class="form-control" placeholder="End Date"
                        value="{{ request('end_date') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select" aria-label="Order Status">
                        <option value="" selected>All</option>
                        <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <!-- <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Canceled</option> -->
                        <!-- <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option> -->
                        <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-200">Apply</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="p-4">
                    <input type="text" placeholder="Start typing to search for Business Owner Sales Report"
                        class="form-control form-control--search mx-auto" id="table-search" />
                </div>
                <div class="sa-divider"></div>
                <table class="sa-datatables-init" data-order="[[ 0, &quot;desc&quot; ]]" data-sa-search-input="#table-search">
                    <thead class="sticky-header">
                        <tr>
                            <th>Order Id</th>
                            <th>Order Date</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Order Amount</th>
                            <th>Order Status</th>
                            <th>Payment Method</th>
                        </tr>
                    </thead>
                    <tbody id="sales-data">
                        @php
                        $totalAmount = 0;
                        @endphp
                        @foreach($salesData as $sale)
                        @php
                        $totalAmount += $sale['grand_total'];
                        @endphp
                        <tr>
                            <td>{{ $sale['id'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($sale['created_at'])->format('d-m-Y') }}</td>
                            <td>{{ $sale['name'] }}</td>
                            <td>{{ $sale['email'] }}</td>
                            <td>{{ $sale['grand_total'] }}</td>
                            <td>{{ $sale['order_status'] }}</td>
                            <td>{{ $sale['payment_method'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Total Amount Row -->
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <h5>Total Sales Amount:</h5>
                        <h5>R {{ number_format($totalAmount, 2) }}</h5>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
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