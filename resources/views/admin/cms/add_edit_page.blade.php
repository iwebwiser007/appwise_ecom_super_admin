@extends('components.admin.layouts')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
@section('styles')
<style>
    .cke_notification_warning {
        display: none !important;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="py-5">
        <div class="row g-4 align-items-center">
            <div class="col-12">
                <nav class="mb-2" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-sa-simple">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <span>&nbsp;/&nbsp;</span>
                        <li class="breadcrumb-item active">Page</li>
                    </ol>
                </nav>


                <div class="d-flex justify-content-between">
                    <h1 class="h3 m-0">Page</h1>
                </div>
            </div>
            <div class="col-12">
                <a class="btn btn-secondary backbtn" href="{{ url()->previous() }}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>


    <form action="{{ isset($page) ? url('admin/update-page/' . $page->id) : url('admin/update-page') }}" method="POST" data-parsley-validate>
        @csrf
        <div class="row">
            <!-- Left Side: Page Details -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="page_title" class="form-label">Page Title</label>
                            <input type="text" class="form-control" id="page_title" name="page_title"
                                value="{{ $page->page_title ?? '' }}" data-parsley-required="true">
                        </div>
                        {{--<div class="mb-3">
                            <label for="url_key" class="form-label">URL Key</label>
                            <input type="text" class="form-control" id="url_key" name="url_key" value="{{ $page->url_key ?? '' }}"
                        required>
                    </div>--}}
                    <div class="mb-3">
                        <label for="html_content" class="form-label">HTML Content</label>
                        <textarea class="form-control ckeditor" id="html_content" name="html_content" rows="10"
                            required>{{ $page->html_content ?? '' }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Page</button>
                </div>
            </div>
        </div>

        <!-- Right Side: Image Upload -->
        <div class="col-lg-4 d-none">
            <div class="card">
                <div class="card-body">
                    <h5>Upload Image</h5>
                    <form id="image-upload-form" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="file" class="form-control" id="image_file" name="image_file" accept="image/*">
                        </div>
                        <button type="button" class="btn btn-success d-none" id="upload-image">Upload</button>
                    </form>
                    <div class="mt-3">
                        <label for="image_url" class="form-label">Image URL</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="image_url" readonly>
                            <button class="btn btn-secondary" id="copy-url" type="button">Copy URL</button>
                        </div>
                    </div>
                    <!-- <div class="mt-3">
                        <label for="image_url" class="form-label">Image URL</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="image_url" readonly>
                            <button class="btn btn-secondary" id="copy-url" type="button">Copy URL</button>
                        </div>
                        <div id="copy-message" style="display: none; color: green; margin-top: 5px;">URL is copied!</div>
                    </div> -->

                </div>
            </div>
        </div>
</div>
</form>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    CKEDITOR.replace('html_content', {
        contentsCss: ['public/front/css/style.css'],
        allowedContent: true,
        extraAllowedContent: 'div(*); img[*]{*}; p(*); h2(*); h3(*);',
        templates_files: ['public/assets/js/editor-templates.js'],
    });
</script>
<script>
    $(document).ready(function() {
        // Initialize CKEditor
        // CKEDITOR.replace('html_content');

        // // Handle Image Upload
        // $('#upload-image').on('click', function() {
        //     var formData = new FormData($('#image-upload-form')[0]); // Get the form data

        //     // Check if a file is selected
        //     if (!$('#image_file')[0].files.length) {
        //         alert('Please select an image first.');
        //         return;
        //     }
        //     $.ajax({
        //         url: "{{ url('admin/upload-image') }}", // Server URL
        //         type: 'POST',
        //         data: formData,
        //         contentType: false, // Don't set content type
        //         processData: false, // Don't process the data
        //         headers: {
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token
        //         },
        //         success: function(data) {
        //             if (data.success) {
        //                 $('#image_url').val(data.public_path); // Set the image URL in the input field
        //                 alert('Image uploaded successfully!');
        //             } else {
        //                 alert('Failed to upload image.');
        //             }
        //         },
        //         error: function(jqXHR, textStatus, errorThrown) {
        //             console.error(textStatus, errorThrown);
        //             alert('There was an error uploading the image.');
        //         }
        //     });
        // });


        $('#image_file').on('change', function() {
            var formData = new FormData();
            var file = this.files[0];
            if (!file) {
                return;
            }
            formData.append('image_file', file);

            $.ajax({
                url: "{{ url('admin/upload-image') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data.success) {
                        $('#image_url').val(data.public_path);
                        toastr.success('Image uploaded successfully!', 'Success', {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 3000,
                        });
                    } else {
                        alert('Failed to upload image.');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus, errorThrown);
                    alert('Error uploading the image.');
                }
            });
        });

        // $('#copy-url').on('click', function() {
        //     var imageUrl = $('#image_url');
        //     imageUrl.select();
        //     document.execCommand('copy');
        //     alert('Image URL copied: ' + imageUrl.val());
        // });

        // $('#copy-url').on('click', function() {
        //     var imageUrl = $('#image_url');
        //     imageUrl.select();
        //     document.execCommand('copy');

        //     // Message show karna
        //     var message = $('#copy-message');
        //     message.show();

        //     // 3 seconds ke baad message hide karna
        //     setTimeout(function() {
        //         message.hide();
        //     }, 3000);
        // });

        $('#copy-url').on('click', function() {
            var imageUrl = $('#image_url');
            imageUrl.select();
            document.execCommand('copy');

            toastr.success('URL is copied!', 'Success', {
                closeButton: true,
                progressBar: true,
                timeOut: 3000,
            });
        });
    });
</script>

@endsection