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
                        <li class="breadcrumb-item active">Permissions</li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between">
                    <h1 class="h3 m-0">Permissions</h1>
                    <a href="{{ route('permissions.create') }}" class="btn btn-primary">New Create</a>
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
                    <input type="text" placeholder="Start typing to search for Permissions"
                        class="form-control form-control--search mx-auto" id="table-search" />
                </div>
                <div class="sa-divider"></div>
                <table class="sa-datatables-init" data-order="[[ 0, &quot;desc&quot; ]]" data-sa-search-input="#table-search">
                    <thead class="sticky-header">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $i = 1;
                        @endphp

                        @forelse ($permissions as $permission)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $permission['name'] ?? "N/A"}}</td>
                            <td>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('permissions.edit', $permission->id) }}" class="actionbtn-tb actionbtn-edit"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit"><i
                                            class="far fa-edit text-white"></i></a>
                                    <a href="#" data-url="{{ route('permissions.delete', $permission['id']) }}"
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
    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-btn') || event.target.closest('.delete-btn')) {
                event.preventDefault();
                const button = event.target.closest('.delete-btn');
                const url = button.getAttribute('data-url');
                confirmDelete(url);
            }
        });
    });

    function confirmDelete(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this permission!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>

@endsection