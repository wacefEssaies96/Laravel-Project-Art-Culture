@extends('layouts.front-office')

<div class="container justify-content-center" style="margin-left:20%">
    <div class="card col-md-8">
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form role="form" method="POST" action="{{ route('payments.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <p class="mb-0">Add a payment</p>
                </div>
            </div>
            <div class="card-body">
                <p class="text-uppercase text-sm">Enter your payment information</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Card_Security_Code" class="form-control-label">Card Security Code</label>
                            <input class="form-control" type="number" name="Card_Security_Code" id="Card_Security_Code">
                            @error('Card_Security_Code')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Cardholder_Name" class="form-control-label">Cardholder Name</label>
                            <input class="form-control" type="text" name="Cardholder_Name" id="Cardholder_Name">
                            @error('Cardholder_Name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Card_Number" class="form-control-label">Card Number</label>
                            <input class="form-control" type="number" name="Card_Number" id="Card_Number">
                            @error('Card_Number')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Card_Expiration_Date" class="form-control-label">Card Expiration Date</label>
                            <input class="form-control" type="date" name="Card_Expiration_Date" id="Card_Expiration_Date">
                            @error('Card_Expiration_Date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Address" class="form-control-label">Address</label>
                            <input class="form-control" type="text" name="Address" id="Address">
                            @error('Address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payment_method" class="form-control-label">Payment Method</label>
                            <select class="form-control" name="payment_method" id="payment_method">
                                <option value="Credit Card">Credit Card</option>
                                <option value="PayPal">PayPal</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                            </select>
                            @error('payment_method')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="field">
                    <div class="control">
                        <button class="btn btn-primary">Pay</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
