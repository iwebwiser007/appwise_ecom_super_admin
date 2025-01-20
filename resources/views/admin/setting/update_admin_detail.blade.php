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
            <li class="breadcrumb-item active">Admin Setting</li>
          </ol>
        </nav>
        <h1 class="h3 m-0">Admin Settings </h1>
      </div>
      <div class="col-12">
        <a class="btn btn-secondary backbtn" href="{{ url()->previous() }}">
          <i class="fa fa-arrow-left" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </div>
  <div class="mb-5">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="mb-5">
              <h2 class="mb-0 fs-exact-18">Update Admin Details</h2>
            </div>


            @if (Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error:</strong> {{ Session::get('error_message') }}
              <button type="button" class="sa-close" data-bs-dismiss="alert" aria-label="Close">

              </button>
            </div>
            @endif



            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">

              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach

              <button type="button" class="sa-close" data-bs-dismiss="alert" aria-label="Close">

              </button>
            </div>
            @endif



            @if (Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success:</strong> {{ Session::get('success_message') }}
              <button type="button" class="sa-close" data-bs-dismiss="alert" aria-label="Close">

              </button>
            </div>
            @endif



            <form class="forms-sample" action="{{ url('admin/update-admin-detail') }}" method="post"
              enctype="multipart/form-data">
              @csrf
              <div class="mb-4">
                <label class="form-label">Admin Username/Email</label>
                <input class="form-control" value="{{ Auth::user()->email }}" readonly>
              </div>
              <div class="mb-4">
                <label class="form-label">Admin Type</label>
                <input class="form-control" value="{{ Auth::user()->type }}" readonly>
              </div>

              <div class="mb-4">
                <label class="form-label" for="admin_name">Name</label>
                <input type="text" class="form-control" id="admin_name" placeholder="Enter Name" name="admin_name"
                  value="{{ Auth::user()->name }}">
              </div>

              <div class="mb-4">
                <label class="form-label" for="admin_mobile">Mobile</label>
                <input type="text" class="form-control" id="admin_mobile" placeholder="Enter Mobile Number"
                  name="admin_mobile" value="{{ Auth::user()->mobile }}" maxlength="10" minlength="10">
              </div>
              <div class="mb-4">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="search_location" placeholder="Search Location">
                  <label for="search_location">Search Location</label>
                </div>
              </div>
              <div id="geomap" class="mb-4" style="min-height:300px;"></div>

              <div class="mb-4">
                <input type="text" class="form-control search_addr" id="admin_address" placeholder=" Address"
                  name="admin_address" value="{{ Auth::user()->address }}">
              </div>
              <div class="mb-4">
                <input type="hidden" class="form-control search_latitude" id="admin_latitude" placeholder=" Latitude"
                  name="admin_latitude" value="{{ Auth::user()->latitude }}">
              </div>
              <div class="mb-4">
                <input type="hidden" class="form-control search_longitude" id="admin_longitude" placeholder=" Longitude"
                  name="admin_longitude" value="{{ Auth::user()->longitude }}">
              </div>
              <div class="mb-4">
                <label class="form-label" for="admin_country">Country</label>
                <input type="text" class="form-control" id="admin_country" placeholder=" Country" name="admin_country"
                  value="{{ Auth::user()->country }}">
              </div>
              <div class="mb-4">
                <label class="form-label" for="admin_state">State</label>
                <input type="text" class="form-control" id="admin_state" placeholder=" State" name="admin_state"
                  value="{{ Auth::user()->state }}">
              </div>
              <div class="mb-4">
                <label class="form-label" for="admin_city">City</label>
                <input type="text" class="form-control" id="admin_city" placeholder="City" name="admin_city"
                  value="{{ Auth::user()->city }}">
              </div>

              <div class="mb-4">
                <label class="form-label" for="admin_pincode">Postal Code</label>
                <input type="text" class="form-control" id="admin_pincode" placeholder=" PinCode" name="admin_pincode"
                  value="{{ Auth::user()->postal_code }}">
              </div>

              <div class="mb-4 col-2">
                <label class="form-label mt-3" for="admin_image">Admin Photo</label>
                <input type="file" class="d-none" id="admin_image" name="admin_image"
                  onchange="previewAdminImage(event)">
                <div class="choosefilenew form-control" onclick="document.getElementById('admin_image').click()"
                  style="height: 200px; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                  <div id="admin-image-message" style="{{ !empty(Auth::user()->image) ? 'display: none;' : '' }}">
                    Click to upload Admin Photo
                  </div>
                  <img id="admin-preview"
                    src="{{ !empty(Auth::user()->image) ? asset('public/admin/images/photos/' . Auth::user()->image) : '' }}"
                    alt="Admin Photo"
                    style="display: {{ !empty(Auth::user()->image) ? 'block' : 'none' }}; max-height: 100%; max-width: 100%; object-fit: contain;">
                </div>

              </div>

              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <button type="reset" class="btn btn-secondary">Cancel</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
@section('scripts')
<script>
function previewAdminImage(event) {
  const img = document.getElementById('admin-preview');
  const file = event.target.files[0];
  const reader = new FileReader();

  reader.onload = function(e) {
    img.src = e.target.result;
    img.style.display = 'block'; // Show the image
    document.getElementById('admin-image-message').style.display = 'none'; // Hide the upload message
  }

  if (file) {
    reader.readAsDataURL(file);
  }
}
</script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script type="text/javascript"
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEFV2UwzAK7fN6CoMHc0uK8TnEZCq7B7w&libraries=places" async
  defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
var geocoder;
var map;
var marker;

/*
 * Google Map with marker
 */
function initialize() {
  var initialLat = $('.search_latitude').val();
  var initialLong = $('.search_longitude').val();
  initialLat = initialLat ? initialLat : 36.169648;
  initialLong = initialLong ? initialLong : -115.141000;

  var latlng = new google.maps.LatLng(initialLat, initialLong);
  var options = {
    zoom: 16,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  map = new google.maps.Map(document.getElementById("geomap"), options);

  geocoder = new google.maps.Geocoder();

  marker = new google.maps.Marker({
    map: map,
    draggable: true,
    position: latlng
  });

  google.maps.event.addListener(marker, "dragend", function() {
    var point = marker.getPosition();
    map.panTo(point);
    geocoder.geocode({
      'latLng': marker.getPosition()
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        marker.setPosition(results[0].geometry.location);
        populateAddressFields(results[0]);
      }
    });
  });

  // Initialize Google Places Autocomplete
  var input = document.getElementById('search_location');
  var autocomplete = new google.maps.places.Autocomplete(input);

  autocomplete.addListener('place_changed', function() {
    var place = autocomplete.getPlace();
    if (place.geometry) {
      var lat = place.geometry.location.lat();
      var lng = place.geometry.location.lng();

      // Update latitude and longitude fields
      $('.search_latitude').val(lat);
      $('.search_longitude').val(lng);

      // Populate address fields
      populateAddressFields(place);

      // Update map and marker position
      var latlng = new google.maps.LatLng(lat, lng);
      map.setCenter(latlng);
      marker.setPosition(latlng);
    }
  });
}

function populateAddressFields(location) {
  $('.search_addr').val(location.formatted_address);
  $('.search_latitude').val(location.geometry.location.lat());
  $('.search_longitude').val(location.geometry.location.lng());

  // Extract city, state, and country from address components
  var components = location.address_components;
  var city = "";
  var state = "";
  var country = "";
  var postalCode = "";

  components.forEach(function(component) {
    if (component.types.includes("locality")) {
      city = component.long_name;
    }
    if (component.types.includes("administrative_area_level_1")) {
      state = component.long_name;
    }
    if (component.types.includes("country")) {
      country = component.long_name;
    }
    if (component.types.includes("postal_code")) {
      postalCode = component.long_name;
    }
  });

  $('#admin_city').val(city);
  $('#admin_state').val(state);
  $('#admin_country').val(country);
  $('#admin_pincode').val(postalCode);
}

$(document).ready(function() {
  // Load google map
  initialize();

  /*
   * Point location on google map
   */
  $('.get_map').click(function(e) {
    var address = $('#search_location').val();
    geocoder.geocode({
      'address': address
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        marker.setPosition(results[0].geometry.location);
        populateAddressFields(results[0]);
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
    e.preventDefault();
  });
});
</script>

@endsection
