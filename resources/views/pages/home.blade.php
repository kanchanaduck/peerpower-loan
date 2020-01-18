@extends('layouts.app')

@section('title', 'All Loans')

@section('content')
    <h2>All Loans</h2>
    <a href="create-loan" class="btn btn-primary">Add New Loan</a>
    <button type="button" class="btn btn-info">Info</button>
    <table class="table table-striped table-hover mt-2">
        <thead>
            <tr class="table-light">
                <th>ID</th>
                <th>Loan Amount</th>
                <th>Loan Term</th>
                <th>Interest Rate</th>
                <th>Created at</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loan_header as $h)
            <tr>
                <td>{{ $h->id }}</td>
                <td>{{ number_format($h->loan_amount, 2) }} ฿</td>
                <td>{{ $h->loan_term }} Years</td>
                <td>{{ number_format($h->interest_rate, 2) }} %</td>
                <td>{{ $h->created_at }}</td>
                <td>
                    <a role="button" href="detail-loan/{{ $h->id }}" class="btn btn-info btn-sm">View</a>
                    <a role="button" href="edit-loan/{{ $h->id }}" class="btn btn-success btn-sm">Edit</a>
                    <button type="button" data-href="{{ route('loan.destroy', ['id' => $h->id]) }}" class="btn btn-delete btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                      Delete
                    </button>
                </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center">
                Data available not found
              </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <form action="/foo/bar" method="post">
        @method('delete')
        @csrf
    </form>
@endsection


@section('scripts')
    <script>
      $(document).on('click','.btn-delete', function () {
          if(confirm('Are you sure to delete this item?')){
            $('form').attr('action', $(this).data('href')).submit()
          }
      })
    </script>
@endsection