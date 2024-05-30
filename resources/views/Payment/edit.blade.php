@extends('layouts.front-office')

<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form role="form" method="POST" action="{{ route('payments.update', $payment->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Update payment information</p>
                            <button type="submit" class="btn btn-primary btn-sm ms-auto">Update</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Payment Information</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Card_Security_Code" class="form-control-label">Card Security Code</label>
                                    <input class="form-control" type="number" name="Card_Security_Code" value="{{ $payment->Card_Security_Code }}" placeholder="Enter the card security code" onfocus="focused(this)" onfocusout="defocused(this)">
                                    @error('Card_Security_Code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Cardholder_Name" class="form-control-label">Cardholder Name</label>
                                    <input class="form-control" type="text" name="Cardholder_Name" value="{{ $payment->Cardholder_Name }}" placeholder="Enter the cardholder name" onfocus="focused(this)" onfocusout="defocused(this)">
                                    @error('Cardholder_Name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Card_Expiration_Date" class="form-control-label">Card Expiration Date</label>
                                    <input class="form-control" type="date" name="Card_Expiration_Date" value="{{ $payment->Card_Expiration_Date }}" placeholder="Enter the card expiration date" onfocus="focused(this)" onfocusout="defocused(this)">
                                    @error('Card_Expiration_Date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Card_Number" class="form-control-label">Card Number</label>
                                    <input class="form-control" type="number" name="Card_Number" value="{{ $payment->Card_Number }}" placeholder="Enter the card number" onfocus="focused(this)" onfocusout="defocused(this)">
                                    @error('Card_Number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Address" class="form-control-label">Address</label>
                                    <input class="form-control" type="text" name="Address" value="{{ $payment->Address }}" placeholder="Enter the address" onfocus="focused(this)" onfocusout="defocused(this)">
                                    @error('Address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_method" class="form-control-label">Payment Method</label>
                                    <select class="form-control" name="payment_method">
                                        <option value="Credit Card" @if ($payment->payment_method === 'Credit Card') selected @endif>Credit Card</option>
                                        <option value="Bank Transfer" @if ($payment->payment_method === 'Bank Transfer') selected @endif>Bank Transfer</option>
                                        <option value="PayPal" @if ($payment->payment_method === 'PayPal') selected @endif>PayPal</option>
                                    </select>
                                    @error('payment_method')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
