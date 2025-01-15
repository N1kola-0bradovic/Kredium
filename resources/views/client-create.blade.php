@extends('adminlte::page')

@section('title', 'Clients')

@section('content_header')
    <h1>Create Client</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('client.store') }}" method="POST">
                @csrf
                
                <h5>Basic Client Data</h5>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                    @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create Client</button>
                    <a href="{{ route('client.index') }}" class="btn btn-secondary">Go Back To Clients</a>
                </div>

                @if(Session::has('successMsg'))
                    <div class="alert alert-success"> {{ Session::get('successMsg') }}</div>
                @endif
            </form>
        </div>
    </div>
@stop