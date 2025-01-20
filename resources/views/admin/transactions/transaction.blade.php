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
            <li class="breadcrumb-item active">Transaction</li>
          </ol>
        </nav>

        <div class="d-flex justify-content-between">
          <h1 class="h3 m-0">Transaction</h1>
          <div class="d-flex align-items-center d-none">
            <button class="btn btn-primary me-3" type="button" data-toggle="collapse" data-target="#filter-section"
              aria-expanded="false" aria-controls="filter-section">Filter</button>
            <form action="{{ url('admin/transaction') }}" method="POST" class="d-inline-block">
              @csrf
              <input type="hidden" name="type" value="export">
              <input type="hidden" name="transaction" value="{{ json_encode($transactions) }}">
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

      </div>
      <div class="col-12">
        <a class="btn btn-secondary backbtn" href="{{ url()->previous() }}">
          <i class="fa fa-arrow-left" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </div>

  <!-- Search Bar -->

  <div id="filter-section" class="collapse row mb-4">
    <div class="col-lg-8">
      <form action="{{ url('admin/transaction') }}" method="post" class="row g-3">
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
          <input type="text" placeholder="Start typing to search for Shop Owners"
            class="form-control form-control--search mx-auto" id="table-search" />
        </div>
        <div class="sa-divider"></div>
        <table class="sa-datatables-init" data-order="[[ 0, &quot;desc&quot; ]]" data-sa-search-input="#table-search">
          <thead class="sticky-header">
            <tr>
              <th>ID</th>
              <th>Onwer Name</th>
              <th>Transaction Id</th>
              <th>Package Name</th>
              <th>Amount</th>
              <th>Payment Method</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @php
            $i = 1;
            @endphp
            @foreach ($transactions as $transaction)
            <tr>
              <td>{{$i}}</td>
              <td><?php $owner = App\Models\ShopOwner::find($transaction->owner_id);
                                ?>{{$owner->name ?? "N/A"}}</td>
              <td>{{$transaction->transaction_id}}</td>
              <td>{{ $transaction->package_name }}</td>
              <td>{{$transaction->amount}}</td>
              <td>{{$transaction->payment_method}}</td>
              <td>
                <div class="d-flex gap-3">
                  <a href="#"
                    data-url="{{ route('admin.delete', ['type' => 'transaction', 'id' => $transaction->id]) }}"
                    class="actionbtn-tb actionbtn-remove delete-btn" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-original-title="Delete">
                    <i class="fas fa-trash-alt"></i>
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
