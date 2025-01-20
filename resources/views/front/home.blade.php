{{--<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Packages</h1>
        <div class="row">
            @foreach($packages as $package)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $package->name }}</h5>
<ul class="list-group list-group-flush">
    <li class="list-group-item">Number of Products: {{ $package->number_of_section }}</li>
    <li class="list-group-item">Number of Categories: {{ $package->number_of_category }}</li>
    <li class="list-group-item">Number of Sections: {{ $package->number_of_product }}</li>
</ul>
<h4 class="text-center mt-3">Price: ${{ $package->price }}</h4>
</div>
<div class="card-footer text-center">
    <a href="{{ route('package.buy', $package->id) }}" class="btn btn-primary">Buy Now</a>
</div>
</div>
</div>
@endforeach
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>--}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Packages</h1>
        <div class="row">
            @foreach($packages as $package)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $package->name }}</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Number of Products: {{ $package->number_of_section }}</li>
                            <li class="list-group-item">Number of Categories: {{ $package->number_of_category }}</li>
                            <li class="list-group-item">Number of Sections: {{ $package->number_of_product }}</li>
                        </ul>
                        <h4 class="text-center mt-3">Price: ${{ $package->price }}</h4>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buyNowModal-{{ $package->id }}">Buy
                            Now</button>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="buyNowModal-{{ $package->id }}" tabindex="-1"
                aria-labelledby="buyNowModalLabel-{{ $package->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="buyNowModalLabel-{{ $package->id }}">Fill Owner Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('package.saveOwnerDetails', $package->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="ownerName-{{ $package->id }}" class="form-label">Owner Name</label>
                                    <input type="text" class="form-control" id="ownerName-{{ $package->id }}" name="owner_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ownerShop-{{ $package->id }}" class="form-label">Shop Name</label>
                                    <input type="text" class="form-control" id="ownerShop-{{ $package->id }}" name="shop_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ownerDomain-{{ $package->id }}" class="form-label">Domain</label>
                                    <input type="text" class="form-control" id="ownerDomain-{{ $package->id }}" name="domain" required>
                                </div>

                                <div class="mb-3">
                                    <label for="ownerPhone-{{ $package->id }}" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="ownerPhone-{{ $package->id }}" name="phone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ownerAddress-{{ $package->id }}" class="form-label">Address</label>
                                    <textarea class="form-control" id="ownerAddress-{{ $package->id }}" name="address" rows="3"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>