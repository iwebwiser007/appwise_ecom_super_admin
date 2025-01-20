<!DOCTYPE html>
<html lang="en" dir="ltr" data-scompiler-id="0">
<!-- Mirrored from stroyka-admin.html.themeforest.scompiler.ru/variants/ltr/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 31 Jul 2024 05:22:39 GMT -->

<head>
    <meta charSet="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-commerce Solution by Appwise</title><!-- icon -->
    <link rel="icon" href="{{ asset('public/admin/images/favicon.ico') }}" type="image/gif/x-icon/png" sizes="16x16">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" />
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('public/admin/vendor/bootstrap/css/bootstrap.ltr.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/vendor/highlight.js/styles/github.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/vendor/simplebar/simplebar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/vendor/quill/quill.snow.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/vendor/air-datepicker/css') }}/datepicker.min.css" />
    <link rel="stylesheet" href="{{ asset('public/admin/vendor/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/vendor/datatables/css/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/vendor/nouislider/nouislider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/vendor/fullcalendar/main.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{asset('public/parsleyjs/parsleycss.css')}}">
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-97489509-8"></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-97489509-8');
    </script>
    @yield('styles')
</head>

<body>
    <!-- sa-app -->
    <div class="sa-app sa-app--desktop-sidebar-shown sa-app--mobile-sidebar-hidden sa-app--toolbar-fixed">
        @include('components.admin.nav')
        <div class="sa-app__content">
            <!-- sa-app__toolbar -->
            @include('components.admin.header')
            <div id="top" class="sa-app__body px-2 px-lg-4 pb-5">
                @yield('content')
            </div>
            @include('components.admin.footer')
        </div>
        <div class="sa-app__toasts toast-container bottom-0 end-0"></div><!-- sa-app__toasts / end -->

        <!-- Status Change Modal -->
        <div class="modal fade" id="statusChangeModal" tabindex="-1" aria-labelledby="statusChangeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusChangeModalLabel">Change Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to change the status?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirmStatusChange">Yes, Change
                            Status</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

    </div><!-- sa-app / end -->



    <!-- scripts -->

    <script src="{{ asset('public/admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/highlight.js/highlight.pack.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/air-datepicker/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/air-datepicker/js/i18n/datepicker.en.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/fontawesome/js/all.min.js') }}" data-auto-replace-svg="" async="">
    </script>
    <script src="{{ asset('public/admin/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/fullcalendar/main.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/stroyka.js') }}"></script>
    <script src="{{ asset('public/admin/js/custom.js') }}"></script>
    <script src="{{ asset('public/admin/js/custom1.js') }}"></script>
    <script src="{{ asset('public/admin/js/calendar.js') }}"></script>
    <script src="{{ asset('public/admin/js/demo.js') }}"></script>
    <script src="{{asset('public/parsleyjs/parsley.min.js')}}"></script>
    <script src="{{ asset('public/admin/js/demo-chart-js.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        var productId, currentStatus, currentType;
        $(document).on('click', '.change-status', function() {
            productId = $(this).data('product-id');
            currentStatus = $(this).data('status');
            currentType = $(this).data('type');
            $('#statusChangeModal').modal('show');
        });

        $("#confirmStatusChange").click(function() {
            var newStatus = currentStatus == 1 ? 0 : 1;
            $.ajax({
                url: "{{ url('admin/change-product-status') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    status: newStatus,
                    type: currentType,
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

        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('delete-btn')) {
                    event.preventDefault();
                    const button = event.target;
                    const url = button.getAttribute('data-url');
                    confirmDelete(url);
                }
            });
        });

        function confirmDelete(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want delete this item!.",
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
    @yield('scripts')
</body>
<!-- Mirrored from stroyka-admin.html.themeforest.scompiler.ru/variants/ltr/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 31 Jul 2024 05:25:05 GMT -->


</html>