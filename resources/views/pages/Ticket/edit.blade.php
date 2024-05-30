@extends('layouts.app')

@section('content')
<div class="container">
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form role="form" method="POST" action="{{ route('tickets.update', $ticket->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Update ticket information</p>
                            <button type="submit" class="btn btn-primary btn-sm ms-auto">Update</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Ticket Information</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_ticket" class="form-control-label">Ticket name</label>
                                    <input class="form-control" type="text" name="name_ticket" value="{{ old('name_ticket', $ticket->name_ticket) }}" placeholder="Enter the ticket name" onfocus="focused(this)" onfocusout="defocused(this)">
                                    @error('name_ticket')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description" class="form-control-label">Description</label>
                                    <input class="form-control" type="text" name="description" value="{{ old('description', $ticket->description) }}" placeholder="Enter the ticket description" onfocus="focused(this)" onfocusout="defocused(this)">
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount" class="form-control-label">Amount</label>
                                    <input class="form-control" type="number" name="amount" value="{{ old('amount', $ticket->amount) }}" placeholder="Enter the price" onfocus="focused(this)" onfocusout="defocused(this)">
                                    @error('amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type" class="form-control-label">Type</label>
                                    <select class="form-control" name="type">
                                        <option value="Standard Ticket" {{ old('type', $ticket->type) === 'Standard Ticket' ? 'selected' : '' }}>Standard Ticket</option>
                                        <option value="VIP Ticket" {{ old('type', $ticket->type) === 'VIP Ticket' ? 'selected' : '' }}>VIP Ticket</option>
                                        <option value="Student Ticket" {{ old('type', $ticket->type) === 'Student Ticket' ? 'selected' : '' }}>Student Ticket</option>
                                        <option value="Family Ticket" {{ old('type', $ticket->type) === 'Family Ticket' ? 'selected' : '' }}>Family Ticket</option>
                                        <option value="Group Ticket" {{ old('type', $ticket->type) === 'Group Ticket' ? 'selected' : '' }}>Group Ticket</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payments_id" class="form-control-label">Payment</label>
                                    <select class="form-control" name="payments_id">
                                        @foreach ($payments as $payment)
                                        <option value="{{ $payment->id }}" {{ old('payments_id', $ticket->payments_id) == $payment->id ? 'selected' : '' }}>
                                            {{ $payment->payment_method }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="evenement_id" class="form-control-label">Event</label>
                                    <select class="form-control" name="evenement_id">
                                        @foreach ($evenements as $event)
                                        <option value="{{ $event->id }}" {{ old('evenement_id', $event->evenement_id) == $event->id ? 'selected' : '' }}>
                                            {{ $event->nom }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ref_ticket" class="form-control-label">Ticket reference</label>
                                    <input class="form-control" type="text" name="ref_ticket" value="{{ old('ref_ticket', $ticket->ref_ticket) }}" placeholder="Enter the reference" onfocus="focused(this)" onfocusout="defocused(this)">
                                    @error('ref_ticket')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
