@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Place Management'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css" />


    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 p-5">
                <div class="card-header pb-0" style="padding: 10px; font-size: 14px;">
                    <h6>Lieux</h6>
                </div>

                <form method="POST" action="{{ route('places.store') }}">
                    @csrf

                    <script>
                        setTimeout(function() {
                            document.querySelectorAll('.alert').forEach(function(alert) {
                                alert.style.display = 'none';
                            });
                        }, 10000);
                    </script>

                    <!-- Add fields for latitude and longitude -->
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                        <input type="text" name="address" class="form-control" placeholder="Address" required>
                        <textarea name="description" class="form-control" placeholder="Description"></textarea>
                        <input type="text" name="category" class="form-control" placeholder="Category">
                        <input type="text" name="facilities" class="form-control" placeholder="Facilities">
                        <textarea name="internal_rules" class="form-control" placeholder="Internal Rules"></textarea>
                        <input type="text" name="phone_number" class="form-control" placeholder="Phone Number">

                        <!-- Add the map container -->
                        <div id="map" style="height: 400px;"></div>

                        <!-- Input fields for latitude and longitude -->
                        <input name="latitude" id="latitude" required>
                        <input name="longitude" id="longitude" required>
                    </div>

                    <!-- Add the submit button -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-sm">Add a place</button>
                    </div>
                </form>

                <script>
                    var map = L.map('map'); // Initialize the map without a specific view

                    // Add a tile layer (e.g., OpenStreetMap)
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                    }).addTo(map);

                    // Add Leaflet.draw features
                    var drawnItems = new L.FeatureGroup();
                    map.addLayer(drawnItems);

                    var drawControl = new L.Control.Draw({
                        edit: {
                            featureGroup: drawnItems
                        }
                    });
                    map.addControl(drawControl);

                    // Function to get and set the user's current position
                    function getCurrentPosition() {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(function(position) {
                                var latitude = position.coords.latitude;
                                var longitude = position.coords.longitude;

                                // Update the input fields with the user's current position
                                document.getElementById('latitude').value = latitude;
                                document.getElementById('longitude').value = longitude;

                                // Set the map view to the user's current position
                                map.setView([latitude, longitude], 13);
                            }, function(error) {
                                console.error('Error getting user location: ' + error.message);

                                // If there is an error, set a default map view (e.g., center on (0, 0))
                                map.setView([0, 0], 13);
                            });
                        } else {
                            console.error('Geolocation is not supported by this browser.');

                            // If geolocation is not supported, set a default map view (e.g., center on (0, 0))
                            map.setView([0, 0], 13);
                        }
                    }

                    // Add an event listener to handle changes when the user interacts with the map
                    map.on('click', function(e) {
                        var latitude = e.latlng.lat;
                        var longitude = e.latlng.lng;

                        // Update the input fields with the selected latitude and longitude
                        document.getElementById('latitude').value = latitude;
                        document.getElementById('longitude').value = longitude;
                    });

                    // Call the getCurrentPosition function to set the user's current position
                    getCurrentPosition();
                </script>




                <script>
                    var map = L.map('map').setView([0, 0], 13); // Initial map view with a center at (0, 0)

                    // Add a tile layer (e.g., OpenStreetMap)
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                    }).addTo(map);

                    // Add a click event handler to the map to set latitude and longitude
                    map.on('click', function(e) {
                        var latitude = e.latlng.lat;
                        var longitude = e.latlng.lng;

                        // Update the input fields with the selected latitude and longitude
                        document.getElementById('latitude').value = latitude;
                        document.getElementById('longitude').value = longitude;
                    });
                </script>

                @if ($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-light" role="alert" style="margin: 5px; padding: 5px; font-size: 12px;">
                            {{ $error }}
                        </div>
                    @endforeach
                    <script>
                        setTimeout(function() {
                            document.querySelectorAll('.alert').forEach(function(alert) {
                                alert.style.display = 'none';
                            });
                        }, 30000);
                    </script>
                @endif
            </div>
        </div>

    </div>

    <div class="card-body p-5">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">map</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Facilities</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Internal Rules</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone Number</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Create Date</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($places as $place)
                        <tr>
                            <td>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        // Get latitude and longitude from data attributes of the div
                                        var mapDiv = document.getElementById("map-{{ $place->id }}");
                                        var latitude = mapDiv.getAttribute("data-latitude");
                                        var longitude = mapDiv.getAttribute("data-longitude");
                                        var name = mapDiv.getAttribute("data-name");

                                        // Convert values to floating-point numbers
                                        latitude = parseFloat(latitude);
                                        longitude = parseFloat(longitude);

                                        // Initialize the map
                                        var map = L.map(mapDiv).setView([latitude, longitude], 13);

                                        // Add a tile layer (e.g., OpenStreetMap)
                                        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                                            maxZoom: 19,
                                        }).addTo(map);

                                        // Add a marker with a popup
                                        L.marker([latitude, longitude])
                                            .addTo(map)
                                            .bindPopup(name)
                                            .openPopup();
                                    });
                                </script>
                                <!-- Add the map container for each place -->
                                <div id="map-{{ $place->id }}" style="height: 300px; width: 300px; margin: 5px;" data-latitude="{{ $place->latitude }}" data-longitude="{{ $place->longitude }}" data-name="{{ $place->name }}"></div>
                            </td>
                            <td>
                                <div class="d-flex px-3 py-1">

                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $place->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-sm font-weight-bold mb-0" style="pointer-events: none;">{{ $place->address }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-sm font-weight-bold mb-0">{{ $place->description }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-sm font-weight-bold mb-0">{{ $place->category }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-sm font-weight-bold mb-0">{{ $place->facilities }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-sm font-weight-bold mb-0">{{ $place->internal_rules }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-sm font-weight-bold mb-0">{{ $place->phone_number }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-sm font-weight-bold mb-0">{{ $place->created_at->format('d/m/Y') }}</p>
                            </td>
                            <td class="align-middle text-end">
                                <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                    <button class="btn btn-warning btn-sm edit-btn" data-place-id="{{ $place->id }}">
                                        <i class="fas fa-edit"></i> edit
                                    </button>
                                    <div style="margin-right: 10px;"></div>
                                    <form method="POST" action="{{ route('places.destroy', $place->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm delete-btn" data-place-id="{{ $place->id }}">
                                            <i class="fas fa-trash-alt"></i> delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr class="edit-form-row" data-place-id="{{ $place->id }}" style="display: none;">
                            <td colspan="15">
                                <form action="{{ route('places.update', $place->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $place->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="address" class=" form-control" placeholder="Address" value="{{ $place->address }}" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="description" class="form-control" placeholder="Description">{{ $place->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="category" class="form-control" placeholder="Category" value="{{ $place->category }}">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="internal_rules" class="form-control" placeholder="Internal Rules">{{ $place->internal_rules }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" value="{{ $place->phone_number }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="latitude" class="form-control" placeholder="Latitude" value="{{ $place->latitude }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="longitude" class="form-control" placeholder="Longitude" value="{{ $place->longitude }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Your JavaScript code for handling edit and delete buttons -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const editButtons = document.querySelectorAll(".edit-btn");
            editButtons.forEach((editButton) => {
                editButton.addEventListener("click", function () {
                    const placeId = this.getAttribute("data-place-id");
                    const editFormRow = document.querySelector(`.edit-form-row[data-place-id="${placeId}"]`);
                    editFormRow.style.display = "table-row";
                });
            });

            const deleteButtons = document.querySelectorAll(".delete-btn");
            deleteButtons.forEach((deleteButton) => {
                deleteButton.addEventListener("click", function () {
                    if (confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
                        // Your delete logic here
                    } else {
                        alert('Suppression annulée.');
                    }
                });
            });
        });
    </script>
   <script>
    // Function to handle location retrieval
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    // Function to display the current position
    function showPosition(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        // Set the latitude and longitude values into the respective form fields
        document.querySelector('input[name="latitude"]').value = latitude;
        document.querySelector('input[name="longitude"]').value = longitude;

        // You can use this latitude and longitude to display the user's location on a map, save it to a database, or perform any other action you need.
    }

    // Function to handle errors
    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("User denied the request for Geolocation.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Location information is unavailable.");
                break;
            case error.TIMEOUT:
                alert("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                alert("An unknown error occurred.");
                break;
        }
    }

    // Call the getLocation function to initiate location retrieval
    getLocation();
</script>

@endsection
