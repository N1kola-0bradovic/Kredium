@extends('adminlte::page')

@section('title', 'Clients')

@section('content_header')
    <h1>Clients</h1>
@endsection

@section('content')
    <div style="margin-bottom: 10px!important">
        <!-- Go Back to Dashboard Button -->
        <a href="{{ route('home') }}" class="btn btn-default">Go Back to Dashboard</a>
        <!-- Create Client Button -->
        <a href="{{ route('client.create') }}" class="btn btn-default">Create Client</a>
    </div>
    <div class="table-responsive">
        <table id="clientsTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Cash Loan</th>
                    <th>Home Loan</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->first_name }}</td>
                        <td>{{ $client->last_name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->cash_loan_tag ? 'Yes' : 'No' }}</td>
                        <td>{{ $client->home_loan_tag ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('client.edit', $client->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('client.destroy', $client->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this client?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#clientsTable').DataTable();
        });
    </script>
@endsection