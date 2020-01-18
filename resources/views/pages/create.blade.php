@extends('layouts.app')

@section('title', 'Create Loan')

@section('content')
<h2 class="col-6 offset-3">Create Loan</h2>
<div class="card card-body col-6 offset-3">
    <form method="post" action="{{ route('loan.store') }}">
        @csrf
        <div class="form-group row">
            <label for="loan_amount" class="col-sm-3 col-form-label">Loan Amount</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <input type="text" autofocus class="form-control @error('loan_amount') is-invalid @enderror" name="loan_amount" id="loan_amount" placeholder="Loan Amount" aria-label="Loan Amount">
                    <div class="input-group-append">
                        <span class="input-group-text" id="loan_amount-span">฿</span>
                    </div>
                    @error('loan_amount')
                    <div class="invalid-feedback">
                        Must be an integer and range between 1,000 - 100,000,000 THB
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="loan_term" class="col-sm-3 col-form-label">Loan Term</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <input type="text" class="form-control @error('loan_term') is-invalid @enderror" name="loan_term" id="loan_term" placeholder="Loan Term"
                        aria-label="Loan Term">
                    <div class="input-group-append">
                        <span class="input-group-text" id="loan_term-span">Years</span>
                    </div>
                    @error('loan_term')
                    <div class="invalid-feedback">
                        Must be an integer and range between 1,000 - 100,000,000 THB
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="interest_rate" class="col-sm-3 col-form-label">Interest Rate</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <input type="text" class="form-control @error('interest_rate') is-invalid @enderror" name="interest_rate" id="interest_rate"
                        placeholder="Interest Rate" aria-label="Interest Rate">
                    <div class="input-group-append">
                        <span class="input-group-text" id="interest_rate-span">%</span>
                    </div>
                    @error('interest_rate')
                <div class="invalid-feedback">
                    Float with two decimal places and range between 1-36%
                </div>
                @enderror
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Start Date</label>
            <div class="col-sm-9">
                <input type="month" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date">
                @error('start_date')
                <div class="invalid-feedback">
                    Float with two decimal places and range between 1-36%
                </div>
                 @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a role="button" href="{{ route('loan') }}" class="btn btn-outline-secondary">Back</a>
            </div>
        </div>
    </form>
</div>
@endsection
