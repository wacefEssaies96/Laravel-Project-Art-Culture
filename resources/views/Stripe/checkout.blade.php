@extends('layouts.front-office')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg" style="margin-left:20%">
    <div class="d-flex flex-column justify-content-center align-items-center h-100">
        <h3 class="text-center mb-4">Get your ticket now</h3>
        <form action="/session" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" id="checkout-live-button" class="btn btn-primary">Checkout</button>
        </form>
    </div>
</main>
