@extends('layouts.front-office')
<div class="error-page" style="margin-left: 20%">
    <h1>Oops! An error occurred.</h1>
    @if (session('error'))
        <p>{{ session('error') }}</p>
    @else
        <p>Something went wrong.</p>
    @endif
    <a href="{{ url('/') }}">Return to Home</a>

</div>
