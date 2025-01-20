@extends('components.admin.layouts')

@section('content')
<div class="container pb-6">
    <div class="py-5">
        <div class="row g-4 align-items-center">
            <div class="col">
                <h1 class="h3 m-0">Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="row g-4 g-xl-5">
        <!-- Total Packages Card -->
        <div class="col-12 col-md-4 d-flex">
            <a href="{{ url('admin/packages') }}" class="card saw-indicator flex-grow-1 d-block text-black dashcrds">
                <div class="sa-widget-header saw-indicator__header">
                    <h2 class="sa-widget-header__title">Total Packages</h2>
                </div>
                <div class="saw-indicator__body">
                    <div class="text-start saw-indicator__value">{{ $totalPackages }}</div>
                    <div class="text-end"><i class="fas fa-cube"></i></div>
                </div>
            </a>
        </div>

        <!-- Active Packages Card -->
        <div class="col-12 col-md-4 d-flex">
            <a href="{{ url('admin/active-packages') }}" class="card saw-indicator flex-grow-1 d-block text-black dashcrds">
                <div class="sa-widget-header saw-indicator__header">
                    <h2 class="sa-widget-header__title">Active Packages</h2>
                </div>
                <div class="saw-indicator__body">
                    <div class="text-start saw-indicator__value">{{ $activePackages }}</div>
                    <div class="text-end"><i class="fas fa-th"></i></div>
                </div>
            </a>
        </div>

        <!-- Total Shop Owners Card -->
        <div class="col-12 col-md-4 d-flex">
            <a href="{{ url('admin/shop-owners') }}" class="card saw-indicator flex-grow-1 d-block text-black dashcrds">
                <div class="sa-widget-header saw-indicator__header">
                    <h2 class="sa-widget-header__title">Total Shop-Owner</h2>
                </div>
                <div class="saw-indicator__body">
                    <div class="text-start saw-indicator__value">{{ $totalShopOwner }}</div>
                    <div class="text-end"><i class="fas fa-dolly-flatbed"></i></div>
                </div>
            </a>
        </div>

        <div class="col-12 col-lg-12 col-xxl-12 d-flex ">
            <div class="card flex-grow-1 saw-chart">
                <div class="sa-widget-header saw-chart__header">
                    <h2 class="sa-widget-header__title">Monthly Packages Bought</h2>
                </div>
                <div>
                    <canvas id="salesChart" style="height: 400px; width: 1202px; "></canvas>
                </div>
                <br>
            </div>
        </div>

        <!-- Recent Inquiry Section -->
        <div class="col-12 col-xxl-12 d-flex">
            <div class="card flex-grow-1 saw-table">
                <div class="sa-widget-header saw-table__header">
                    <h2 class="sa-widget-header__title">Recent Inquiry</h2>
                    <a href="{{ url('admin/inquiries') }}" class="ms-auto">
                        <button class="btn btn-primary px-4 py-2 rounded shadow-sm">
                            All Inquiry
                        </button>
                    </a>
                </div>
                <div class="saw-table__body sa-widget-table">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Message</th>
                                <!-- <th>Status</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentInquiries as $inquiry)
                            <tr>
                                <td>{{ $inquiry->id  }}</td>
                                <td>{{ $inquiry->name ?? 'N/A' }}</td>
                                <td>{{ $inquiry->email ?? 'N/A' }}</td>
                                <td>{{ $inquiry->phone ?? 'N/A' }}</td>
                                <td>{{ $inquiry->address ?? 'N/A' }}</td>
                             {{--   <td>{{ Str::limit($inquiry->message ?? 'N/A') }}</td> --}}
                             @if (strlen($inquiry->message) > 50)
                             <td>
                                <span>{{ substr($inquiry->message, 0, 30) }}...</span>
                                <span data-bs-toggle="modal" data-bs-target="#messageModal{{ $inquiry->id }}" class="badge bg-info"
                                    style="cursor:pointer; color:black;">Read
                                    More</span>
                                </td>
                                @elseif (strlen($inquiry->message) < 50)
                                <td>
                                <span>{{ $inquiry->message }}</span>
                                </td>
                                @endif

                               
                                <!-- <td>
                                    @if ($inquiry->status == 'in_progress')
                                    <span class="badge bg-warning">In Progress</span>
                                    @elseif ($inquiry->status == 'resolved')
                                    <span class="badge bg-success">Resolved</span>
                                    @else
                                    <span class="badge bg-info">New</span>
                                    @endif
                                </td> -->
                            </tr>
                            <div class="modal fade" id="messageModal{{ $inquiry->id }}" tabindex="-1"
                            aria-labelledby="messageModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="messageModalLabel">Inquiry Message</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ $inquiry->message }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


        

        <div class="col-12 col-xxl-12 d-flex">
            {{--
    <div class="card flex-grow-1 saw-table">
        <div class="sa-widget-header saw-table__header">
            <h2 class="sa-widget-header__title">Sales Report</h2>
        </div>
        <div class="saw-table__body sa-widget-table text-nowrap">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Shop Owner Name</th>
                        <th>Total Sales</th>
                    </tr>
                </thead>
                <tbody>


                </tbody>
            </table>
        </div>
    </div>
    --}}
        </div>


    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var labels = @json($labels);
    var data = @json($data);

    console.log(labels); // ['Jan 2025']
    console.log(data); // [1] (example)

    var getCurrentYear = new Date().getFullYear();

    // Filter data for the current year
    var currentYearData = data.filter((value, index) => {
        var labelYear = labels[index].split(' ')[1];
        return labelYear == getCurrentYear;
    });

    var currentYearLabels = labels.filter((label, index) => {
        var labelYear = label.split(' ')[1];
        return labelYear == getCurrentYear;
    });

    // Get all months in short format from January to December
    var allMonths = [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug',
        'Sep', 'Oct', 'Nov', 'Dec'
    ];

    // Ensure all months are shown on the x-axis (format as 'Month Year' like 'Jan 2025')
    var fullLabels = allMonths.map(month => {
        return month + ' ' + getCurrentYear; // Format labels as 'Jan 2025'
    });

    // Create data array for the current year, filling missing months with 0
    var fullData = fullLabels.map(month => {
        var index = currentYearLabels.indexOf(month);
        return index !== -1 ? currentYearData[index] : 0; // If data exists, use it; else set to 0
    });

    // Calculate max data value and add extra space to it
    var maxDataValue = Math.max(...fullData);
    var suggestedMax = maxDataValue + (maxDataValue * 0.1); // Adding 10% extra space

    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: fullLabels,
            datasets: [{
                label: 'Packages Bought',
                data: fullData,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false, // To allow resizing based on container
            responsive: true, // To make the chart responsive
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true,
                    suggestedMax: suggestedMax // Setting the suggested maximum y-value
                }
            }
        }
    });
</script>



@endsection