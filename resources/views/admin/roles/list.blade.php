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
                        <li class="breadcrumb-item active">Roles</li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between">
                    <h1 class="h3 m-0">Roles</h1>
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">New Create</a>
                </div>
                @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <strong>Success:</strong> {{ Session::get('success_message') }}
                    <button type="button" class="sa-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                    <input type="text" placeholder="Start typing to search for Roles"
                        class="form-control form-control--search mx-auto" id="table-search" />
                </div>
                <div class="sa-divider"></div>
                <table class="sa-datatables-init" data-order="[[ 0, &quot;desc&quot; ]]" data-sa-search-input="#table-search">
                    <thead class="sticky-header">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Permission</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $i = 1;
                        @endphp

                        @forelse ($roles as $role)
                        @if($role['name'] != "superadmin")
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $role['name'] ?? "N/A"}}</td>
                            <td>
                                @php
                                $permissions = $role->permissions->pluck('name')->implode(', ');
                                @endphp

                                <!-- Truncate the permission string for display in the table -->
                                @if (strlen($permissions) > 50)
                                <span>{{ substr($permissions, 0, 50) }}...</span>
                                <span data-bs-toggle="modal" data-bs-target="#permissionModal{{ $role['id'] }}" class="badge bg-info" style="cursor:pointer; color:black;">Read More</span>
                                @else
                                {{ $permissions }}
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('roles.edit', $role['id']) }}" class="actionbtn-tb actionbtn-edit"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit"><i
                                            class="far fa-edit text-white"></i></a>

                                    <a href="#" data-url="{{ route('roles.delete', $role['id']) }}"
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

                        <!-- Modal for displaying full permissions list -->
                        <div class="modal fade" id="permissionModal{{ $role['id'] }}" tabindex="-1" aria-labelledby="permissionModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="permissionModalLabel">Permissions for {{ $role['name'] }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                        <!-- Displaying permissions list in proper format -->
                                        <ul class="row">
                                            @foreach ($role->permissions as $permission)
                                            <div class="col-4 d-flex align-items-center permission-checkbox mt-3"> 
                                                <i class=" me-2 fas fa-check-square mr-2 text-info"></i>
                                                {{ $permission->name }}
                                            </div>
                                            @endforeach
                                        </ul>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No roles found</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection