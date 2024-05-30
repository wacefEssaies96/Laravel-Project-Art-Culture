@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Area Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Area</h6>
                </div>
                <form method="POST" action="{{ route('areas.store') }}">
                    @csrf

                    <!-- Add the JavaScript code for hiding alerts outside the form tag -->
                    <script>
                        setTimeout(function() {
                            document.querySelectorAll('.alert').forEach(function(alert) {
                                alert.style.display = 'none';
                            });
                        }, 10000);
                    </script>

                    <!-- Add the fields for the area -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Address" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" placeholder="Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="capacity">Capacity</label>
                        <input type="text" name="capacity" class="form-control" placeholder="Capacity">
                    </div>
                    <div class="form-group">
                        <label for="places_id">Place</label>
                        <select name="places_id" class="form-control" required>
                            <option value="">Select a place</option>
                            @foreach ($places as $place)

                            <option value="{{ $place->id }}">{{ $place->name }}</option>
                        @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" name="postal_code" class="form-control" placeholder="Postal Code">
                    </div>
                    <div class="form-group">
                        <label for="rental_cost">Rental Cost</label>
                        <input type="text" name= "rental_cost" class="form-control" placeholder="Rental Cost">
                    </div>
                    <div class="form-group">
                        <label for="availability">Availability</label>
                        <div>
                            <input type="radio" name="availability" value="1" id="available" required>
                            <label for="available">Available</label>
                        </div>
                        <div>
                            <input type="radio" name="availability" value="0" id="not-available">
                            <label for="not-available">Not Available</label>
                        </div>
                    </div>

                    <!-- Add the submit button -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-sm">Add an area</button>
                    </div>
                </form>

                @if ($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-light" role="alert">
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
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Capacity</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Place</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Postal Code</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rental Cost</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Availability</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($areas as $area)
                                    @php
                                        $place = App\Models\Place::find($area->places_id);
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div>
                                                    <img src="./img/team-1.jpg" class="avatar me-3" alt="image">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $area->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0" style="pointer-events: none;">{{ $area->address }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $area->description }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $area->capacity }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $place->name }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $area->postal_code }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $area->rental_cost }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $area->availability ? 'Available' : 'Not Available' }}</p>
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <button class="btn btn-warning btn-sm edit-btn" data-area-id="{{ $area->id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <div style="margin right: 10px;"></div>
                                                <form method="POST" action="{{ route('areas.destroy', $area->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm delete-btn" data-area-id="{{ $area->id }}">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="edit-form-row" data-area-id="{{ $area->id }}" style="display: none;">
                                        <td colspan="15">
                                            <form action="{{ route('areas.update', $area->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $area->name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="address" class="form-control" placeholder="Address" value="{{ $area->address }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" class="form-control" placeholder="Description">{{ $area->description }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="capacity" class="form-control" placeholder="Capacity" value="{{ $area->capacity }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="places_id">Place</label>
                                                    <select name="places_id" class="form-control" required>
                                                        @foreach ($areas as $area)
                                                            @php
                                                                $place = App\Models\Place::find($area->places_id);
                                                            @endphp
                                                            <option value="{{ $place->id }}" @if ($place->id === $area->places_id) selected @endif>{{ $place->name }}</option>
                                                        @endforeach

                                                        <!-- Afficher d'autres options si le lieu n'est pas associé à l'Area -->
                                                        @foreach ($places as $place)
                                                            @if (!$areas->contains('places_id', $place->id))
                                                                <option value="{{ $place->id }}">{{ $place->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <input type="text" name="postal_code" class="form-control" placeholder="Postal Code" value="{{ $area->postal_code }}">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="rental_cost" class="form-control" placeholder="Rental Cost" value="{{ $area->rental_cost }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="availability">Availability</label>
                                                    <div>
                                                        <input type="radio" name="availability" value="1" id="available" required>
                                                        <label for ="available">Available</label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" name="availability" value="0" id="not-available">
                                                        <label for="not-available">Not Available</label>
                                                    </div>
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
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const editButtons = document.querySelectorAll(".edit-btn");
            editButtons.forEach((editButton) => {
                editButton.addEventListener("click", function () {
                    const areaId = this.getAttribute("data-area-id");
                    const editFormRow = document.querySelector(`.edit-form-row[data-area-id="${areaId}"]`);
                    editFormRow.style.display = "table-row";
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const deleteButtons = document.querySelectorAll(".delete-btn");
            deleteButtons.forEach((deleteButton) => {
                deleteButton.addEventListener("click", function (event) {
                    if (!confirm('Are you sure you want to delete this item?')) {
                        event.preventDefault();
                        alert('Deletion canceled.');
                    }
                });
            });
        });
    </script>
@endsection
