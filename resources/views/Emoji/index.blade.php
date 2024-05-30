@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Emoji'])

@if ($message = Session::get('success'))
<div class="alert alert-success" role="alert" style="margin: 0 10px;">
    <p>{{ $message }}</p>
</div>
@endif
<div class="card shadow-lg mx-4 card-profile-bottom">
    <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="{{ asset('img/team-1.jpg') }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        Sayo Kravits
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        Public Relations
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                                <i class="ni ni-email-83"></i>

                                <span class="ms-2">Messages</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                <i class="ni ni-app"></i>

                                <span class="ms-2">App</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                <i class="ni ni-settings-gear-65"></i>
                                <span class="ms-2">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0">
                    <form action="{{ route('emoji.store') }}" method="POST">
                        @csrf
                        <div class="d-flex align-items-center row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    @error('emj')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    <label for="example-text-input" class="form-control-label">Emoji content</label>
                                    <textarea id="textareaEmoji" class="form-control" rows="3" type="text" name="emj"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-primary btn-sm ms-auto">Add Emoji</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="card-body">
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">All Emojis </p>

                    <!-- @ foreach ($emojisapi as $emojiapi)
                    { { $emojiapi }}
                    @ endforeach -->
                    @if ($emojis->count() > 0)
                    <ul class="col-12">
                        <li class=" pe-2  align-items-center">
                            <ul class=" px-2 py-3 me-sm-n4">
                                <li class="mb-2">
                                    <a class="border-radius-md">
                                        <div class="row">
                                            @foreach ($emojis as $emoji)
                                            <div class="col-4 btn btn-outline-primary">
                                                {{ $emoji->emj }}
                                                <p class="text-xs text-secondary mb-5">
                                                    <i class="fa fa-clock me-1"></i>
                                                    {{ $emoji->created_at }}
                                                </p>

                                                <button type="button" class="delete-btn btn btn-danger "  onclick="showAlertDialog({{$emoji}})"><i class="far fa-trash-alt "></i></button>
                                            </div>
                                            @endforeach
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div id="overlay" class="overlay"></div>

                    <div id="alertBox" class="alert-box">
                        <div class="alert-header">
                            Are you sure you want to delete emoji <span id="emojiToDelete"></span> ?
                        </div>
                        
                        <div class="alert-content">
                            <div class="d-flex flex-row-reverse">
                                <form action="{{ route('emoji.destroy','') }}" method="POST" id="deleteEmoji">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger "><i class="far fa-trash-alt "></i></button>
                                </form>
                                &nbsp;
                                <button type="button" class="btn btn-outline-primary " onclick="closeAlertDialog()">Cancel</button>

                            </div>
                        </div>
                    </div>
                    <script>
                        function showAlertDialog(emoji) {
                            console.log("data"+JSON.stringify(emoji));
                            document.getElementById("emojiToDelete").textContent = emoji["emj"];
                            document.getElementById("deleteEmoji").action = "{{ route('emoji.destroy', '') }}" + "/" + emoji["id"];

                            document.getElementById("overlay").style.display = "block";
                            document.getElementById("alertBox").style.display = "block";
                        }

                        function closeAlertDialog() {
                            document.getElementById("overlay").style.display = "none";
                            document.getElementById("alertBox").style.display = "none";
                        }
                    </script>
                </div>
                @else
                No emoji yet
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <img src="{{ asset('img/bg-profile.jpg') }}" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-4 col-lg-4 order-lg-2">
                        <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                            <a href="javascript:;">
                                <img src="{{ asset('img/team-2.jpg') }}" class="rounded-circle img-fluid border border-2 border-white">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                    <div class="d-flex justify-content-between">
                        <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-none d-lg-block">Connect</a>
                        <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-block d-lg-none"><i class="ni ni-collection"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block">Message</a>
                        <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-block d-lg-none"><i class="ni ni-email-83"></i></a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                <div class="d-grid text-center">
                                    <span class="text-lg font-weight-bolder">22</span>
                                    <span class="text-sm opacity-8">Friends</span>
                                </div>
                                <div class="d-grid text-center mx-4">
                                    <span class="text-lg font-weight-bolder">10</span>
                                    <span class="text-sm opacity-8">Photos</span>
                                </div>
                                <div class="d-grid text-center">
                                    <span class="text-lg font-weight-bolder">89</span>
                                    <span class="text-sm opacity-8">Comments</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h5>
                            Mark Davis<span class="font-weight-light">, 35</span>
                        </h5>
                        <div class="h6 font-weight-300">
                            <i class="ni location_pin mr-2"></i>Bucharest, Romania
                        </div>
                        <div class="h6 mt-4">
                            <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                        </div>
                        <div>
                            <i class="ni education_hat mr-2"></i>University of Computer Science
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
</div>
@endsection