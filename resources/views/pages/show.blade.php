@extends('layouts.app')

@section('title', 'Loan Details')

@section('content')


    <h2>Loan Details</h2>
    <div class="col-4 my-2">
        <table>
            <tr>
                <th>ID:</th>
                <td>{{ $loan_header->id }}</td>
            </tr>
            <tr>
                <th class="pr-3">Loan Amount:</th>
                <td>{{ number_format($loan_header->loan_amount, 2) }} ฿</td>
            </tr>
            <tr>
                <th>Loan Term:</th>
                <td>{{ $loan_header->loan_term }} Years</td>
            </tr>
            <tr>
                <th>Intereat Rate:</th>
                <td>{{ number_format($loan_header->interest_rate, 2) }} %</td>
            </tr>
            <tr>
                <th>Created at:</th>
                <td>{{ $loan_header->created_at }}</td>
            </tr>
        </table>
    </div>

    <a href="{{ route('loan') }}" class="btn btn-outline-secondary mb-3">Back</a>
    
    <h3>Repayment Schedules</h3>
    <table class="table table-striped mt-2">
        <thead>
            <tr class="table-light">
                <th>Payment No</th>
                <th>Date</th>
                <th>Payment Amount</th>
                <th>Principal</th>
                <th>Interest</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loan_line as $line)
            <tr>
                <td>{{ $line->line_no }}</td>
                <td>{{ date("M Y", strtotime($line->date)) }}</td>
                <td>{{ number_format($line->payment_amount, 2) }}</td>
                <td>{{ number_format($line->principal, 2) }}</td>
                <td>{{ number_format($line->interest, 2) }}</td>
                <td>{{ number_format($line->balance, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

        <a href="{{ route('loan') }}" class="btn btn-outline-secondary mb-3">Back</a>
@endsection