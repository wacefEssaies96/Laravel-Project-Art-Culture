@extends('layouts.app')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg" style="margin-left:20%">

    <div class="container">
        <h1>Payment Details</h1>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ticket name: {{ $ticket->name_ticket }}</h5>
                        <p class="card-text">Amount: {{ $ticket->amount }}</p>
                        <p class="card-text">Type: {{ $ticket->type }}</p>
                        <p class="card-text">Description: {{ $ticket->description }}</p>
                        <p class="card-text">Ticket reference: {{ $ticket->ref_ticket }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
