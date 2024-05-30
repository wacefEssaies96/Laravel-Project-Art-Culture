@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Domain'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-7 mt-4">
                <div class="card" style="margin-left:35%; width:100%;">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Domain Information</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <span class="mb-2 text-xs">Domain Name: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $domain->name }}</span></span>
                                    <span class="mb-2 text-xs">Domain Description: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $domain->description }}</span></span>
                                </div>
                            </li>
                        </ul>
                        <a style="color: #fb6340; margin-top: 2%;" class="btn btn-light"
                            href="{{ route('domain-management.index') }}">Previous
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
