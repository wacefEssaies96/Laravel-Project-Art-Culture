<!DOCTYPE html>
<html>
<head>
    <title>Payment Form</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h1>Payment Form</h1>
    <form action="{{ route('payment-process') }}" method="post" id="payment-form">
        @csrf

        <div class="form-group">
            <label for="card-holder-name">Cardholder Name</label>
            <input type="text" name="card-holder-name" id="card-holder-name" required>
        </div>

        <div class="form-group">
            <label for="card-element">Card Details</label>
            <div id="card-element"></div>
        </div>

        <button type="submit">Pay</button>
    </form>

    <script>
        var stripe = Stripe('{{ config('services.stripe.key') }}');
        var elements = stripe.elements();

        var card = elements.create('card');
        card.mount('#card-element');
    </script>
</body>
</html>