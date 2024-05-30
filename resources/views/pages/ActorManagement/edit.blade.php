@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Artist Management'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 p-4">
                    <h2>Update an Artist</h2>
                    @if (session('status'))
                        <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('actor-management.update') }}?id={{ $actor->id }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputEmail1">FullName</label>
                            <input name="fullName" type="text" class="form-control" placeholder="Enter fullName"
                                value="{{ $actor->fullName }}">
                            @error('fullName')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="domains">Select Domain(s):</label>
                            <div class="select is-multiple">
                                <select name="domains[]" multiple class="form-control">
                                    @foreach ($domains as $domain)
                                        <option value="{{ $domain->id }}">
                                            {{ in_array($domain->id, $actor->domains->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $domain->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="email" type="email" class="form-control" placeholder="exemple@exemple.com"
                                value="{{ $actor->email }}">
                            @error('email')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Birth Date</label>
                            <input name="birthDate" type="date" class="form-control" placeholder="Enter birthDate"
                                value="{{ $actor->birthDate }}">
                            @error('birthDate')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Birth Place</label>
                            <input name="birthPlace" type="text" class="form-control" placeholder="Enter birthPlace"
                                value="{{ $actor->birthPlace }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Biography</label>
                            <textarea name="biography" type="text" class="form-control" placeholder="Enter biography">{{ $actor->biography }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nationality</label>
                            <input name="nationality" type="text" class="form-control" placeholder="Enter nationality"
                                value="{{ $actor->nationality }}">
                        </div>
                        @if ($actor->profilePicture)
                            <img src="/actorPictures/{{ $actor->profilePicture }}" alt="Current Profile Picture"
                                width="150">
                            <input type="hidden" name="profilePicture" value="{{ $actor->profilePicture }}">
                            @error('profilePicture')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        @else
                            <p>No profile picture available, Please select one !</p>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputPassword1">Profile Picture</label>
                            <input name="profilePicture" type="file" class="form-control"
                                placeholder="Enter profilePicture">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phone Number</label>
                            <input name="phoneNumber" type="text" class="form-control" placeholder="Enter phone number"
                                value="{{ $actor->phoneNumber }}">
                            @error('phoneNumber')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Social Connections</label>
                            <textarea name="socialConnections" type="text" class="form-control" placeholder="Enter socialConnections">{{ $actor->socialConnections }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Discography</label>
                            <textarea name="discography" type="text" class="form-control" placeholder="Enter discographyr">{{ $actor->discography }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Availability</label>
                            <input name="availability" type="text" class="form-control" placeholder="Enter availability"
                                value="{{ $actor->availability }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
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
