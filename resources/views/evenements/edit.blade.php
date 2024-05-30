@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Event Management'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="card mb-4 p-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Events</h6>
                    <div class="pull-right mb-2">
                        <a class="btn btn-success" href="{{ route('events.index') }}"> Return to events</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="{{ route('events.update', $evenement->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Event Name:</strong>
                                    <input type="text" name="nom" value="{{ $evenement->nom }}" class="form-control"
                                        placeholder="Event name">
                                    @error('nom')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    @if ($evenement->image)
                                    <img src="/eventImages/{{ $evenement->image }}" alt="image" style="width: 300px;">
                                    <input type="hidden" name="image" value="{{ $evenement->image }}">
                                    @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                @else
                                    <p>No image available, Please select one !</p>
                                @endif
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Image</label>
                                    <input name="image" type="file" class="form-control"
                                        placeholder="Enter image">
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <strong>Event start date:</strong>
                                        <input type="datetime-local" name="dateDebut" class="form-control"
                                            value="{{ $evenement->date_debut }}">
                                        @error('dateDebut')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <strong>Event end date:</strong>
                                        <input type="datetime-local" name="dateFin" class="form-control"
                                            value="{{ $evenement->date_fin }}">
                                        @error('dateFin')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Description:</strong>
                                    <textarea name="description" class="form-control">{{ $evenement->description }}</textarea>
                                    @error('description')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary ml-3">Submit</button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
