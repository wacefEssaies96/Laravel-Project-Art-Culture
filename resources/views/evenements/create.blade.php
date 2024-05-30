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
                    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Event Name:</strong>
                                    <input type="text" name="nom" class="form-control" placeholder="Event Name">
                                    @error('nom')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Image</label>
                                        <input name="image" type="file" class="form-control"
                                            placeholder="Enter Image">
                                        @error('image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <strong>Start date:</strong>
                                        <input type="datetime-local" name="dateDebut" class="form-control">
                                        @error('dateDebut')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <strong>End date:</strong>
                                        <input type="datetime-local" name="dateFin" class="form-control">
                                        @error('dateFin')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Description:</strong>
                                    <textarea name="description" class="form-control"></textarea>
                                    @error('description')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="actors">Select actor(s):</label>
                                    <div class="select is-multiple">
                                        <select name="actors[]" multiple class="form-control">
                                            @foreach ($actors as $actor)
                                                <option value="{{ $actor->id }}">
                                                    {{ $actor->fullName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="places">Select place(s):</label>
                                    <div class="select">
                                        <select name="place_id" multiple class="form-control">
                                            @foreach ($places as $place)
                                                <option value="{{ $place->id }}">
                                                    {{ $place->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
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
