@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Create a new Artist'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 p-4">
                    <div class="row">
                        <h2>Add a new Artist</h2>
                        @if ($imageElement)
                            @if ($imageElement !== null)
                                <div class="table-responsive p-4">
                                    <table class="table align-items-center justify-content-center mb-0">
                                        <tbody>
                                            <img src="{{ $imageElement }}" alt="bruce" id="preview">
                                            @foreach ($data as $key => $value)
                                                <tr>
                                                    <p class="text-sm font-weight-normal mb-0">
                                                        @if ($key == 'Naissance')
                                                            <div class="text-secondary font-weight-semibold opacity-7">
                                                                {{ $key }} : </div>
                                                            {{ $value[0] }}
                                                        @endif
                                                    </p>
                                                </tr>
                                                <tr>
                                                    <p class="text-sm font-weight-normal mb-0">
                                                        @if ($key == 'Nom de naissance')
                                                            <div class="text-secondary font-weight-semibold opacity-7">
                                                                {{ $key }} : </div>
                                                            {{ $value[0] }}
                                                        @endif
                                                    </p>
                                                </tr>
                                                <tr>
                                                    <span class="text-sm font-weight-normal">
                                                        @if ($key == 'Pseudonyme')
                                                            <div class="text-secondary font-weight-semibold opacity-7">
                                                                {{ $key }} : </div>
                                                            {{ $value[0] }}
                                                        @endif
                                                    </span>
                                                </tr>
                                                <tr>
                                                    <p class="text-sm font-weight-normal mb-0">
                                                        @if ($key == 'Nationalité')
                                                            <div class="text-secondary font-weight-semibold opacity-7">
                                                                {{ $key }} : </div>
                                                            {{ $value[0] }}
                                                        @endif
                                                    </p>
                                                </tr>
                                                <tr>
                                                    <span class="text-sm font-weight-normal">
                                                        @if ($key == 'Formation')
                                                            <div class="text-secondary font-weight-semibold opacity-7">
                                                                {{ $key }} : </div>
                                                            {{ $value[0] }}
                                                        @endif
                                                    </span>
                                                </tr>
                                                <tr>
                                                    <p class="text-sm font-weight-normal mb-0">
                                                        @if ($key == 'Activité')
                                                            <div class="text-secondary font-weight-semibold opacity-7">
                                                                {{ $key }} : </div>
                                                            {{ $value[0] }}
                                                        @endif
                                                    </p>
                                                </tr>
                                                <tr>
                                                    <span class="text-sm font-weight-normal">
                                                        @if ($key == 'Activité')
                                                            <div class="text-secondary font-weight-semibold opacity-7">
                                                                {{ $key }} : </div>
                                                            {{ $value[0] }}
                                                        @endif
                                                    </span>
                                                </tr>
                                                <tr>
                                                    <p class="text-sm font-weight-normal mb-0">
                                                        @if ($key == "Période d'activité")
                                                            <div class="text-secondary font-weight-semibold opacity-7">
                                                                {{ $key }} : </div>
                                                            {{ $value[0] }}
                                                        @endif
                                                    </p>
                                                </tr>
                                                <tr>
                                                    <span class="text-sm font-weight-normal">
                                                        @if ($key == 'Conjoint')
                                                            <div class="text-secondary font-weight-semibold opacity-7">
                                                                {{ $key }} : </div>
                                                            {{ $value[0] }}
                                                        @endif
                                                    </span>
                                                </tr>
                                                <tr>
                                                    <p class="text-sm font-weight-normal mb-0">
                                                        @if ($key == 'Enfant')
                                                            <div class="text-secondary font-weight-semibold opacity-7">
                                                                {{ $key }} : </div>
                                                            {{ $value[0] }}
                                                        @endif
                                                    </p>
                                                </tr>
                                                <tr>
                                                    <span class="text-sm font-weight-normal">
                                                        @if ($key == 'Instruments')
                                                            <div class="text-secondary font-weight-semibold opacity-7">
                                                                {{ $key }} : </div>
                                                            {{ $value[0] }}
                                                        @endif
                                                    </span>
                                                </tr>
                                                <tr>
                                                    <p class="text-sm font-weight-normal mb-0">
                                                        @if ($key == 'Genres artistiques')
                                                            <div class="text-secondary font-weight-semibold opacity-7">
                                                                {{ $key }} : </div>
                                                            {{ $value[0] }}
                                                        @endif
                                                    </p>
                                                </tr>
                                                <tr>
                                                    <span class="text-sm font-weight-normal">
                                                        @if ($key == 'Site web')
                                                            <div class="text-secondary font-weight-semibold opacity-7">
                                                                {{ $key }} : </div> <a
                                                                href="https://fr.wikipedia.org/wiki/{{ $value[0] }}">{{ $key }}
                                                                {{ $value[0] }}</a>
                                                        @endif
                                                    </span>
                                                </tr>
                                                <tr>
                                                    <p class="text-sm font-weight-normal mb-0">
                                                        @if ($key == 'Films notables')
                                                            <div class="text-secondary font-weight-semibold opacity-7">
                                                                {{ $key }} : </div>
                                                            {{ $value[0] }}
                                                        @endif
                                                    </p>
                                                </tr>
                                                <tr>
                                                    <span class="text-sm font-weight-normal">
                                                        @if ($key == 'Discographie')
                                                            <div class="text-secondary font-weight-semibold opacity-7">
                                                                {{ $key }} : </div> <a
                                                                href="https://fr.wikipedia.org/wiki/{{ $value[0] }}">
                                                                {{ $value[0] }}</a>
                                                        @endif
                                                    </span>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endif
                    </div>
                    <form action="{{ route('actor-management.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">FullName</label>
                            <input name="fullName" type="text" class="form-control" placeholder="Enter fullName">
                            @error('fullName')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="domains">Select Domain(s):</label>
                            <div class="select is-multiple">
                                <select name="domains[]" multiple class="form-control">
                                    @foreach ($domains as $domain)
                                        <option value="{{ $domain->id }}">
                                            {{ $domain->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="email" type="email" class="form-control" placeholder="exemple@exemple.com">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Birth Date</label>
                            <input name="birthDate" type="date" class="form-control" placeholder="Enter birthDate">
                            @error('birthDate')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Birth Place</label>
                            <input name="birthPlace" type="text" class="form-control" placeholder="Enter birthPlace">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Biography</label>
                            <textarea name="biography" type="text" class="form-control" placeholder="Enter biography"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nationality</label>
                            <input name="nationality" type="text" class="form-control" placeholder="Enter nationality">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Profile Picture</label>
                            <input name="profilePicture" type="file" class="form-control"
                                placeholder="Enter profilePicture">
                            @error('profilePicture')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phone Number</label>
                            <input name="phoneNumber" type="text" class="form-control"
                                placeholder="Enter phone number">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Social Connections</label>
                            <textarea name="socialConnections" type="text" class="form-control" placeholder="Enter socialConnections"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Discographyr</label>
                            <textarea name="discography" type="text" class="form-control" placeholder="Enter discographyr"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Availability</label>
                            <input name="availability" type="text" class="form-control"
                                placeholder="Enter availability">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
