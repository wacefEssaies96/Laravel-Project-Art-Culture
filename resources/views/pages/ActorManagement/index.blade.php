@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Artist Management'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    @if (session('success'))
                        <div class="mt-4 alert alert-success notification is-success" id="success-message" role="alert"
                            style="width: 40%; display:flex; justify-content: center; margin-left: 30%;">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mt-4 alert alert-danger notification is-danger" id="error-message" role="alert"
                            style="width: 40%; display:flex; justify-content: center; margin-left: 30%;">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card-header pb-0">
                        {{-- <a id="addActor" class="btn" style="color: #fb6340;">Add New
                            Artist</a> --}}
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            Enter artist name to scrape information form the web
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mt-n6 mb-6">
                                            <div class="col-lg-12 col-sm-12 mt-5">
                                                <div class="card blur border border-white mb-4 shadow-xs">
                                                    <div class="card-body p-4">
                                                        <form action="{{ route('actor-management.create') }}" method="GET"
                                                            id="search-form">
                                                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                                                <div class="input-group">
                                                                    <span class="input-group-text text-body"><i
                                                                            class="fas fa-search"
                                                                            aria-hidden="true"></i></span>
                                                                    <input style="width: 25%;" type="text"
                                                                        class="form-control" name="fullName"
                                                                        placeholder="Scrape Artist by name...">
                                                                </div>
                                                                <button style="margin-top: 4%; margin-left:3%;"
                                                                    type="submit" class="btn btn-sm btn-dark"
                                                                    id="searchButton">Search</button>
                                                            </div>
                                                        </form>
                                                        <div class="ms-md-auto pe-md-3 d-flex align-items-center mt-4">
                                                            <p>If you don't want to scrape, skip this
                                                                and
                                                                click this button</p>
                                                            <a href="{{ route('actor-management.create') }}"
                                                                style="margin-top: 4%; margin-left:3%;" type="submit"
                                                                class="btn btn-sm btn-danger" id="searchButton">Skip</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn" style="color: #fb6340;" data-toggle="modal"
                            data-target="#exampleModalCenter">
                            Add New
                            Artist
                        </button>
                        <h6>List of Artists</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            FullName / Email</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            BirthDate / BirthPlace</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Biography</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nationality</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Domains</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            PhoneNumber</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            SocialConnections</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Discography</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Availability</th>
                                        <th class="text-secondary opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($actors as $actor)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="/actorPictures/{{ $actor->profilePicture }}"
                                                            class="avatar avatar-sm me-3" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $actor->fullName }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $actor->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $actor->birthDate }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $actor->birthPlace }}</p>
                                            </td>
                                            <td class="tdStyle" style="width: 400px; white-space: normal;">
                                                <p class="text-xs font-weight-bold mb-0">{{ $actor->biography }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $actor->nationality }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                <ul>
                                                    @foreach ($actor->domains as $domain)
                                                        <li>{{ $domain->name }}</li>
                                                    @endforeach
                                                </ul>
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $actor->phoneNumber }}</p>
                                            </td>
                                            <td class="tdStyle" style="width: 400px; white-space: normal;">
                                                <p class="text-xs font-weight-bold mb-0">{{ $actor->socialConnections }}
                                                </p>
                                            </td>
                                            <td class="tdStyle" style="width: 400px; white-space: normal;">
                                                <p class="text-xs font-weight-bold mb-0">{{ $actor->discography }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="badge badge-sm bg-gradient-success">{{ $actor->availability }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a class="btn btn-warning"
                                                    href="{{ route('actor-management.edit') }}?id={{ $actor->id }}">Edit
                                                    <i class="fas fa-pencil-alt me-2" aria-hidden="true"></i></a>
                                                <button class="btn btn-danger delete-object">Delete
                                                    <i class="far fa-trash-alt me-2"></i>
                                                </button>
                                                <a class="btn btn-success"
                                                    href="{{ route('actor.show') }}?id={{ $actor->id }}">More info</a>
                                            </td>
                                            <!-- Delete Confirmation Modal -->
                                            <div class="modal fade" id="deleteConfirmationModal" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Confirm Delete
                                                            </h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this Artist?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <form
                                                                action="{{ route('actor-management.destroy', $actor->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete
                                                                    <i class="far fa-trash-alt me-2"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        @include('layouts.footers.auth.footer')
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        var $successMessage = $('#success-message');

        if ($successMessage.length) {
            $successMessage.fadeIn().delay(2000).fadeOut();
        }
    });

    $(document).ready(function() {
        $('.delete-object').on('click', function(e) {
            e.preventDefault();

            $('#deleteConfirmationModal').modal('show');

            $('#deleteConfirmationModal').on('click', '.btn-secondary', function() {
                $('#deleteConfirmationModal').modal('hide');
            });

            $('#deleteConfirmationModal').on('click', '.btn-danger', function() {
                $(this).off('click');
                $(this).text('Deleting...');

                $(this).closest('form').submit();
            });
        });

        $('#addActor').on('click', function(e) {
            e.preventDefault();

            $('#addModal').modal('show');

            $('#addModal').on('click', '.btn-secondary', function() {
                $('#addModal').modal('hide');
            });

            $('#addModal').on('click', '.btn-danger', function() {
                $(this).off('click');
                $(this).text('Skipping...');

                $(this).closest('form').submit();
            });
        });
    });
</script>
