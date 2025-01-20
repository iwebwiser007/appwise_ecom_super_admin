<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .payment-conf {
            background: #f5f7fa;
            height: 100vh;
            overflow: auto;
        }

        .payment-conf .container .card {
            max-width: 500px;
            box-shadow: 0 1px 3px #00000026;
            position: relative;
            background-color: #fff;
            border-radius: 8px;
            padding: 40px;
            margin: auto;
            border: 0 solid rgba(0, 0, 0, 0.125);
        }

        .text-primary {
            color: #00b0ff !important;
        }

        .btn-primary {
            background: #00b0ff !important;
            border-color: #00b0ff !important;
        }

        .btn-primary:hover {
            color: #fff;
            background: #00b0ff;
            border-color: #00b0ff;
        }

        .form-check-input:checked {
            background-color: #00b0ff;
            border-color: #00b0ff;
        }
    </style>
</head>

<body>


    <section class="p-5 payment-conf">
        <div class="container mt-5">
            <div class="card">
                <h5>Payment for {{ $package->name }}</h5>
                <h5 class=" text-primary d-flex justify-content-between">Amount: <span>R{{ $package->price }}</span></h5>
                <hr>
                <form action="{{ route('package.processPayment', ['id' => $package->id]) }}" method="POST">
                    @csrf
                    <!-- Hidden Fields for Owner Details -->
                    <input type="hidden" name="owner_id" value="{{ $owner_id }}">
                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                    <input type="hidden" name="price" value="{{ $package->price }}">

                    <!-- Payment Method Selection -->
                    <div class="mb-4">
                        <h5>Select Payment Method</h5>
                        {{--<div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod"
                                value="cod" required>
                            <label class="form-check-label" for="cod">Cash on Delivery</label>
                        </div>--}}
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="payfast" value="payfast" required>
                            <label class="form-check-label" for="payfast">Online Payment</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Proceed to Payment</button>
                </form>
            </div>

        </div>
    </section>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>