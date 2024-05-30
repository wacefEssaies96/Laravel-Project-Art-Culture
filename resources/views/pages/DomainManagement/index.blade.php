@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Domain Management'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 m-5 p-4">
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
                        <a class="btn" style="color: #fb6340;" href="{{ route('domain-management.create') }}">Add New
                            Domain</a>
                        <h6>List of Domains</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Description</th>
                                        <th class="text-secondary opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($domains as $domain)
                                        <tr>
                                            <td>
                                                <p class="font-weight-bold mb-0">{{ $domain->name }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $domain->description }}</p>
                                            </td>
                                            <td class="align-middle">
                                                <a class="btn btn-warning"
                                                    href="{{ route('domain-management.edit', $domain->id) }}">Edit
                                                    <i class="fas fa-pencil-alt me-2" aria-hidden="true"></i></a>
                                                <button class="btn btn-danger delete-object">Delete
                                                    <i class="far fa-trash-alt me-2"></i>
                                                </button>
                                                <a class="btn btn-success"
                                                    href="{{ route('domain-management.show', $domain->id) }}">More info</a>
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
                                                            Are you sure you want to delete this Domain?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <form
                                                                action="{{ route('domain-management.destroy', $domain->id) }}"
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
                <div class="card mb-4 m-5 p-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Domain Name</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Artists FullName</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($actorsByDomain as $domain)
                                        <tr>
                                            <td>
                                                <p class="font-weight-bold mb-0">{{ $domain->name }}</p>
                                            </td>
                                            @foreach ($domain->actors as $actor)
                                                <td class="align-middle">
                                                    {{ $actor->fullName }}
                                                </td>
                                            @endforeach
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
    });
</script>
