@extends('adminlte::page')

@section('title', 'Report')

@section('content_header')
    <h1>Loans</h1>
@endsection

@section('content')
    <table id="loansTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Product Type</th>
                <th>Product Value</th>
                <th>Creation Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allLoans as $loan)
                <tr>
                    <td>{{ $loan['product_type'] }}</td>
                    <td>{{ number_format($loan['product_value'], 2) }}</td>
                    <td>{{ $loan['creation_date']->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('report.export') }}" class="btn btn-primary">Export to CSV</a>

@endsection

@section('js')
    <script>
        $(function () {
            $('#loansTable').DataTable({
                "order": [[ 2, "desc" ]] // Order by creation date, newest first
            });
        });
    </script>
@endsection