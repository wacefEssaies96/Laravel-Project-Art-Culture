@extends('layouts.front-with-navbar')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl
        {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }}" id="navbarBlur" data-scroll="false" style="background-color: #0f172a">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Event</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Event</h6>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="/event/list">Events</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/artists">Artiste</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/payments">Payments</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/tickets">Tickets</a>
                  </li>
                </ul>
              </div>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here...">
                </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-white font-weight-bold px-0">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">Log out</span>
                        </a>
                    </form>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                    </a>

                </li>
            </ul>
        </div>
    </div>
</nav>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <div class="px-5 py-4 container-fluid ">
        <!-- style="margin-top: -10%;" -->

        <div class="mt-5 mb-5 mt-lg-9 row justify-content-center">
            <div class="col-lg-9 col-12">
                <div class="card card-body" id="profile">
                    <img src="../../../assets-front-office/img/header-orange-purple.jpg" alt="pattern-lines" class="top-0 rounded-2 position-absolute start-0 w-100 h-100">
                    <div class="row z-index-2 justify-content-center align-items-center">
                        <div class="col-sm-auto col-8 my-auto">
                            <div class="h-100">
                                <h5 class="mb-1 font-weight-bolder">
                                    Event
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-5 row justify-content-center">
                <div class="card   col-6" id="basic-info">
                    <div class="card-header">
                        <h5>{{ $evenement->nom }}</h5>
                    </div>
                    <div class="pt-0 card-body">
                        <img src="/eventImages/{{ $evenement->image }}" width="300" alt="{{ $evenement->nom }}">
                        <p>{{ $evenement->date_debut }} - {{ $evenement->date_fin }}</p>
                        {{ $evenement->description }}
                    </div>

                    <form action="{{ route('commentonEvent') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$evenement->id}}" name="reId">
                        <div class="d-flex align-items-center row">
                            <div class="form-group col-8">
                                <label for="example-text-input" class="form-control-label">Comment content</label>
                                <textarea class="form-control " rows="3" type="text" name="ContentEvent"></textarea>
                                @error('ContentEvent')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                                @if (session('errorEmj'))
                                <div class="alert alert-danger">
                                    {{ session('errorEmj') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-4">
                                <button type="submit" class=" btn btn-primary btn-sm ms-auto">Add Comment</button>
                            </div>
                        </div>
                    </form>

                    @if(count($commentaires)<=0) 
                    <div style="color:white;" class="alert alert-info">
                        You can react add comment
                    </div>
                @endif
                <hr class="horizontal dark">
                <p class="text-uppercase text-sm">All Comments </p>
                @if (count($commentaires) > 0)
                    @foreach ($commentaires as $comment)
                    @if($comment->evenement_id == $evenement->id)
                    @include('Commentaire.showFront', ['commentaire' => $comment,'emojis' => $emojis,'ev'=> $evenement])
                    @endif
                    @endforeach
                </div>
                @else
                No comment yet
                @endif
                
            @if(count($evenement->articles)>=0)
        <div class="card  col-6">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3>List of related articles : </h3>

                    </div>
                    <div class="card-body">
                        <hr>
                        @foreach ($evenement->articles as $article)
                        <a href="{{ route('articles.show', $article->id) }}">
                            <div class="col">
                                <img style="width: 75px;" src="/articleImages/{{ $article->image }}">
                                <label>Title</label> <span>{{ $article->titre }}</span>
                                <p>{{ $article->description }}</p>
                            </div>
                        </a>
                        <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        </div>
    </div>
    </div>
    </div>
    </div>
    <footer class="footer pt-3  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-xs text-muted text-lg-start">
                        Copyright
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        Corporate UI by
                        <a href="https://www.creative-tim.com" class="text-secondary" target="_blank">Creative
                            Tim</a>.
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link text-xs text-muted" target="_blank">Creative Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link text-xs text-muted" target="_blank">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/blog" class="nav-link text-xs text-muted" target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/license" class="nav-link text-xs pe-0 text-muted" target="_blank">License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</main>
<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="fa fa-cog py-2"></i>
    </a>
    <div class="card shadow-lg ">
        <div class="card-header pb-0 pt-3 ">
            <div class="float-start">
                <h5 class="mt-3 mb-0">Corporate UI Configurator</h5>
                <p>See our dashboard options.</p>
            </div>
            <div class="float-end mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0">
            <!-- Sidebar Backgrounds -->
            <div>
                <h6 class="mb-0">Sidebar Colors</h6>
            </div>
            <a href="javascript:void(0)" class="switch-trigger background-color">
                <div class="badge-colors my-2 text-start">
                    <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                </div>
            </a>
            <!-- Sidenav Type -->
            <div class="mt-3">
                <h6 class="mb-0">Sidenav Type</h6>
                <p class="text-sm">Choose between 2 different sidenav types.</p>
            </div>
            <div class="d-flex">
                <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-slate-900" onclick="sidebarType(this)">Dark</button>
                <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
            </div>
            <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
            <!-- Navbar Fixed -->
            <div class="mt-3">
                <h6 class="mb-0">Navbar Fixed</h6>
            </div>
            <div class="form-check form-switch ps-0">
                <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
            </div>
            <hr class="horizontal dark my-sm-4">
            <a class="btn bg-gradient-dark w-100" target="_blank" href="https://www.creative-tim.com/product/corporate-ui-dashboard-laravel">Free Download</a>
            <a class="btn btn-outline-dark w-100" target="_blank" href="https://www.creative-tim.com/learning-lab/bootstrap/installation-guide/corporate-ui-dashboard">View
                documentation</a>
            <div class="w-100 text-center">
                <a class="github-button" href="https://github.com/creativetimofficial/corporate-ui-dashboard" target="_blank" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/corporate-ui-dashboard on GitHub">Star</a>
                <h6 class="mt-3">Thank you for sharing!</h6>
                <a href="https://twitter.com/intent/tweet?text=Check%20Corporate%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fcorporate-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                    <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/corporate-ui-dashboard-laravel" class="btn btn-dark mb-0 me-2" target="_blank">
                    <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                </a>
            </div>
        </div>
    </div>
</div>