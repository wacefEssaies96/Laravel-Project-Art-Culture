@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Artist'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-7 mt-4">
                <div class="card" style="margin-left:35%; width:100%;">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Artist Information</h6>
                    </div>
                    <div class="card-body border-0 d-flex p-4 m-2 bg-gray-100 border-radius-lg">
                        <div class="row gx-4">
                            <div class="col-auto">
                                <div class="avatar avatar-xl position-relative">
                                    <img src="/actorPictures/{{ $actor->profilePicture }}" class="avatar avatar-xl me-3"
                                        alt="user1">
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1">
                                        {{ $actor->fullName }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <span class="mb-2 text-xs">Artist Domain(s): <span
                                            class="text-dark font-weight-bold ms-sm-2">
                                            <ul>
                                                @foreach ($actor->domains as $domain)
                                                    <li>{{ $domain->name }}</li>
                                                @endforeach
                                            </ul>
                                        </span></span>
                                    <span class="mb-2 text-xs">Artist birthDate: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $actor->birthDate }}</span></span>
                                    <span class="mb-2 text-xs">Artist birthPlace: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $actor->birthPlace }}</span></span>
                                    <span class="mb-2 text-xs">Artist biography: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $actor->biography }}</span></span>
                                    <span class="mb-2 text-xs">Artist nationality: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $actor->nationality }}</span></span>
                                    <span class="mb-2 text-xs">Artist email: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $actor->email }}</span></span>
                                    <span class="mb-2 text-xs">Artist phoneNumber: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $actor->phoneNumber }}</span></span>
                                    <span class="mb-2 text-xs">Artist socialConnections: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $actor->socialConnections }}</span></span>
                                    <span class="mb-2 text-xs">Artist discography: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $actor->discography }}</span></span>
                                    <span class="mb-2 text-xs">Artist availability: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $actor->availability }}</span></span>
                                </div>
                            </li>
                        </ul>
                        <a style="color: #fb6340; margin-top: 2%;" class="btn btn-light"
                            href="{{ route('actor-management.index') }}">Previous
                            page</a>
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
