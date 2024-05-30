@extends('layouts.front-office')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl
        {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }}" id="navbarBlur" data-scroll="false" style="background-color: #0f172a">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Page</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Payement</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Payement</h6>
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
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    
    <div class="row mt-4 mx-4">
    <div class="col-12">
    <div class="alert alert-light d-flex justify-content-between align-items-center" role="alert">
    <span>Payments section</strong></span>
    {{-- <a class="btn btn-primary btn-sm"  target="_blank" type="button" href="{{ route('payments.create') }}">Add a payment</a> --}}
    <a class="btn btn-primary btn-sm"  target="_blank" type="button" href="{{ route('payments.create') }}">Add a payment</a>
</div>

    <div class="card mb-4">
    <div class="card-header pb-0">
    <h6>Payments</h6>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">Card Security Code</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Cardholder_Name</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">Card Number</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">Card Expiration Date</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">Address</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">Payment method</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <td class="align-middle text-center">{{ $payment->Card_Security_Code }}</td>
                        <td class="align-middle text-center">{{ $payment->Cardholder_Name }}</td>
                        <td class="align-middle text-center">{{ $payment->Card_Number }}</td>
                        <td class="align-middle text-center">{{ $payment->Card_Expiration_Date}}</td>
                        <td class="align-middle text-center">{{ $payment->Address }}</td>
                        <td class="align-middle text-center">{{ $payment->payment_method }}</td>
                        <td class="align-middle text-center">
                            <a class="btn btn-primary btn-sm" href="{{ route('payments.edit', $payment->id) }}">Edit</a>
                            <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this payment?')">Delete</button>
                            </form>
                            <a class="btn btn-info btn-sm" href="{{ route('payments.show', $payment->id) }}">Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></main>
    <div class="fixed-plugin ps">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
    <i class="fa fa-cog py-2" aria-hidden="true"> </i>
    </a>
    <div class="card shadow-lg">
    <div class="card-header pb-0 pt-3 ">
    <div class="float-start">
    <h5 class="mt-3 mb-0">Argon Configurator</h5>
    <p>See our dashboard options.</p>
    </div>
    <div class="float-end mt-4">
    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
    <i class="fa fa-close" aria-hidden="true"></i>
    </button>
    </div>
    
    </div>
    <hr class="horizontal dark my-1">
    <div class="card-body pt-sm-3 pt-0 overflow-auto">
    
    <div>
    <h6 class="mb-0">Sidebar Colors</h6>
    </div>
    <a href="javascript:void(0)" class="switch-trigger background-color">
    <div class="badge-colors my-2 text-start">
    <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
    <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
    <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
    <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
    <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
    <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
    </div>
    </a>
    
    <div class="mt-3">
    <h6 class="mb-0">Sidenav Type</h6>
    <p class="text-sm">Choose between 2 different sidenav types.</p>
    </div>
    <div class="d-flex">
    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2 disabled" data-class="bg-white" onclick="sidebarType(this)">White</button>
    <button class="btn bg-gradient-primary w-100 px-3 mb-2 disabled" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
    </div>
    <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
    
    <div class="d-flex my-3">
    <h6 class="mb-0">Navbar Fixed</h6>
    <div class="form-check form-switch ps-0 ms-auto my-auto">
    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
    </div>
    </div>
    <hr class="horizontal dark my-sm-4">
    <div class="mt-2 mb-5 d-flex">
    <h6 class="mb-0">Light / Dark</h6>
    <div class="form-check form-switch ps-0 ms-auto my-auto">
    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
    </div>
    </div>
    <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard-laravel" target="_blank">Free Download</a>
    <a class="btn btn-outline-dark w-100" href="/docs/bootstrap/overview/argon-dashboard/index.html" target="_blank">View documentation</a>
    <div class="w-100 text-center">
    <span></span>
    <h6 class="mt-3">Thank you for sharing!</h6>
    <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20and%20%40UPDIVISION%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard-laravel" class="btn btn-dark mb-0 me-2" target="_blank">
    <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
    </a>
    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard-laravel" class="btn btn-dark mb-0 me-2" target="_blank">
    <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
    </a>
    </div>
    </div>
    </div>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
    
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>
    
    <script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
    
    <script src="assets/js/argon-dashboard.js"></script>
    ;
    <script defer="" src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854" integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg==" data-cf-beacon="{&quot;rayId&quot;:&quot;80f5b4b708070daa&quot;,&quot;token&quot;:&quot;1b7cbb72744b40c580f8633c6b62637e&quot;,&quot;version&quot;:&quot;2023.8.0&quot;,&quot;si&quot;:100}" crossorigin="anonymous"></script>
    
    
    </main>