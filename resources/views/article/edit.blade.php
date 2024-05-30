@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Article Management'])
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    <div class="row mt-4 mx-4">
        <div class="col-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="card mb-4 p-4">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Articles</h6>
                    <div class="pull-right mb-2">
                        <a class="btn btn-success" href="{{ route('articles.index') }}"> Return to articles</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="{{ route('articles.update', $article->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Title:</strong>
                                    <input type="text" name="title" class="form-control" placeholder="Title"
                                        value="{{ $article->titre }}">
                                    @error('title')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                @if ($article->image)
                                    <img src="/articleImages/{{ $article->image }}" alt="image" style="width: 300px;">
                                    <input type="hidden" name="image" value="{{ $article->image }}">
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

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Description:</strong>
                                    <textarea name="description" class="form-control">{{ $article->description }}</textarea>
                                    @error('description')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Content:</strong>
                                    <textarea id="content" name="content" class="form-control">{{ $article->contenu }}</textarea>
                                    @error('content')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="places">Select event:</label>
                                    <div class="select">
                                        <select name="event_id" class="form-control">
                                            @foreach ($events as $event)
                                                <option value="{{ $event->id }}">
                                                    {{ $event->nom }}
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
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
