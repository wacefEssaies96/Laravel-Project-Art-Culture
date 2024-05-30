@extends('layouts.front-office')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg" style="margin-left:20%">

    <div class="container">
        <h1>Payment Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Card_Security_Code: {{ $payment->Card_Security_Code }}</h5>
                <p class="card-text">Cardholder Name  {{ $payment->Cardholder_Name }}</p>
                <p class="card-text">Card Number : {{ $payment->Card_Number }}</p>
                <p class="card-text">Card Expiration Date : {{ $payment->Card_Expiration_Date }}</p>
                <p class="card-text">Address: {{ $payment->Address }}</p>
                <p class="card-text">Payment method: {{ $payment->payment_method }}</p>

            </div>
        </div>
    </div>
</main>
