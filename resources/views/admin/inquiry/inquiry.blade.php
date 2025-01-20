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
                        <li class="breadcrumb-item active">Inquiries</li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between">
                    <h1 class="h3 m-0">Inquiries</h1>
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


    <!-- Inquiries Table -->
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
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Message</th>
                            <!-- <th>Status</th> -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $i = 1;
                        @endphp
                        @foreach ($inquiries as $inquiry)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $inquiry->name }}</td>
                            <td>{{ $inquiry->email }}</td>
                            <td>{{ $inquiry->phone }}</td>
                            <td>{{ $inquiry->address }}</td>
                            {{--<td>{{ Str::limit($inquiry->message) }}</td>--}}
                            <td>
                                {{ Str::limit($inquiry->message, 20) }}
                                @if (strlen($inquiry->message) > 20)
                                <span data-bs-toggle="modal" data-bs-target="#messageModal{{ $inquiry->id }}" class="badge bg-info"
                                    style="cursor:pointer; color:black;">Read
                                    More</span>
                                @endif
                            </td>
                            <!-- <td>
                                @if ($inquiry->status == 'in_progress')
                                <span class="badge bg-warning">In Progress</span>
                                @elseif ($inquiry->status == 'resolved')
                                <span class="badge bg-success">Resolved</span>
                                @else
                                <span class="badge bg-info">New</span>
                                @endif
                            </td> -->
                            <td>
                                <div class="d-flex gap-3">
                                    <a href="{{ url('admin/inquiry_details/' . $inquiry->id) }}" class="actionbtn-tb actionbtn-edit"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="View">
                                        <i class="far fa-eye text-white"></i>
                                    </a>

                                    <a href="#" data-url="{{ route('admin.delete', ['type' => 'inquiry', 'id' => $inquiry['id']]) }}"
                                        class="actionbtn-tb actionbtn-remove delete-btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                        </a>
                                </div>
                            </td>
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