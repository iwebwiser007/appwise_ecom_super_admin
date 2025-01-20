@extends('components.admin.layouts')

@section('content')
<div class="container">
    <div class="py-5">
        <h1 class="h3 mb-3">Admin & Front Logos</h1>
        <div class="mb-5">
            <a class="btn btn-secondary backbtn" href="{{ url()->previous() }}">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        </div>
        @if (Session::has('success_message'))
        <!-- Check AdminController.php, updateAdminPassword() method -->
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong>Success:</strong> {{ Session::get('success_message') }}
            <button type="button" class="sa-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
        @endif

        <form action="{{ url('admin/logo') }}" method="POST" enctype="multipart/form-data">
            @csrf


            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6 position-relative">
                            <div>
                                <h6>Admin Logo (200px x 200px)</h6>
                                <label for="admin_logo" class="border p-4 d-flex justify-content-center mb-5 cursor-pointer">



                                    <div class="max-w-20x text-center">
                                        <div class="d-flex align-items-center justify-content-center flex-column">
                                            @if(empty($setting['admin_logo']))
                                            <span id="upload-text">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                    class="bi bi-upload" viewBox="0 0 16 16">
                                                    <path
                                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                                    <path
                                                        d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                                </svg>
                                                <div class="mt-3">Upload file here...</div>
                                            </span>
                                            @endif
                                        </div>
                                        <img id="admin_preview"
                                            src="{{ !empty($setting['admin_logo']) ? asset('public/admin/images/logo/' . $setting['admin_logo']) : '' }}"
                                            alt="Admin Logo Preview"
                                            style="width: 200px; height: 200px; margin-top: 10px; display: {{ !empty($setting['admin_logo']) ? 'block' : 'none' }};">
                                    </div>
                                    <input type="file" class="form-control position-absolute" id="admin_logo" name="admin_logo"
                                        style="opacity: 0; cursor: pointer; height: 200px; width: 200px; top: 0; left: 0;"
                                        onchange="previewImage(event, 'admin_preview')">
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <div>
                                <h6>Front Logo (200px x 200px)</h6>
                                <label for="front_logo" class="border p-4 d-flex justify-content-center mb-5 cursor-pointer">

                                    <div class="max-w-20x text-center">
                                        <div class="d-flex align-items-center justify-content-center flex-column">
                                            @if(empty($setting['front_logo']))
                                            <span id="upload-text_front">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                    class="bi bi-upload" viewBox="0 0 16 16">
                                                    <path
                                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                                    <path
                                                        d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                                </svg>
                                                <div class="mt-3">Upload file here...</div>
                                            </span>
                                            @endif
                                        </div>


                                        <img id="front_preview"
                                            src="{{ !empty($setting['front_logo']) ? asset('public/front/images/logo/' . $setting['front_logo']) : '' }}"
                                            alt="Front Logo Preview"
                                            style="width: 200px; height: 200px; margin-top: 10px; display: {{ !empty($setting['front_logo']) ? 'block' : 'none' }};">
                                    </div>
                                    <input type="file" class="form-control position-absolute d-none" id="front_logo" name="front_logo"
                                        style="opacity: 0; cursor: pointer; height: 200px; width: 200px; top: 0; left: 0;"
                                        onchange="previewImage(event, 'front_preview')">
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(event, previewId) {
        const preview = document.getElementById(previewId);
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);

            if (previewId === "front_preview") {
                const uploadText = document.getElementById('upload-text_front')
                uploadText.style.display = 'none';
            } else {
                const uploadText = document.getElementById('upload-text')
                uploadText.style.display = 'none';
            }
        } else {
            preview.style.display = 'none';
        }
    }
</script>
@endsection