@extends('adminlte::page')

@section('title', 'Clients')

@section('content_header')
    <h1>Create Client</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
        <form action="{{ isset($client) ? route('client.update', $client->id) : route('client.store') }}" method="POST">
                @csrf
                @if(isset($client))
                    @method('PUT')
                @endif

                <h5>Basic Client Data</h5>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', isset($client) ? $client->first_name : '') }}" required>
                    @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', isset($client) ? $client->last_name : '') }}" required>
                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', isset($client) ? $client->phone : '') }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', isset($client) ? $client->email : '') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Cash Loan -->
                <h5>Cash Loan Application</h5>
                <div class="form-group">
                    <label for="loan_amount">Loan Amount</label>
                    <input type="text" name="loan_amount" id="loan_amount" class="form-control @error('loan_amount') is-invalid @enderror" value="{{ old('loan_amount', isset($client) ? (isset($client->cashLoan) ? $client->cashLoan->loan_amount : null ): null) }}" {{ (isset($client->homeLoan) && $client->homeLoan->user_id !== auth()->user()->id) ? 'disabled' : '' }}>
                    @error('loan_amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Home Loan -->
                <h5>Home Loan Application</h5>
                <div class="form-group">
                    <label for="property_value">Property Loan</label>
                    <input type="text" name="property_value" id="property_value" class="form-control @error('property_value') is-invalid @enderror" value="{{ old('property_value', isset($client) ? (isset($client->homeLoan) ? $client->homeLoan->property_value : null ): null) }}" {{ (isset($client->homeLoan) && $client->homeLoan->user_id !== auth()->user()->id) ? 'disabled' : '' }}>
                    @error('property_value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="down_payment_amount">Down Payment Amount</label>
                    <input type="text" name="down_payment_amount" id="down_payment_amount" class="form-control @error('down_payment_amount') is-invalid @enderror" value="{{ old('down_payment_amount', isset($client) ? (isset($client->homeLoan) ? $client->homeLoan->down_payment_amount : null ): null) }}" {{ (isset($client->homeLoan) && $client->homeLoan->user_id !== auth()->user()->id) ? 'disabled' : '' }}>
                    @error('down_payment_amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Client</button>
                    <a href="{{ route('client.index') }}" class="btn btn-secondary">Go Back To Clients</a>
                </div>
                @if(Session::has('successMsg'))
                    <div class="alert alert-success"> {{ Session::get('successMsg') }}</div>
                @endif
            </form>
        </div>
    </div>
@stop