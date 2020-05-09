@extends('layouts.main')

@section('content')
<div class="card-body">
  @if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
  @endif

  <div class="d-flex justify-content-between">
    <h3>Tables</h3>
    <a href="{{ route('table.create') }}" class="btn btn-primary">Create table</a>
  </div>

  <div class="row mt-3">
    <div class="col-md-12">
      <table class="table table-stripped">
        <tr>
          <th>Number</th>
          <th>Number of People</th>
          <th>Min Deposit</th>
          <th colspan="3">Actions</th>
        </tr>
        @if(count($tables) > 0)
        @foreach ($tables as $table)
        <tr>
          <td>{{ $table->number }}</td>
          <td>{{ $table->people_count }}</td>
          <td>{{ $table->min_deposit }}</td>
          <td>
            <a href="{{ route('table.edit', $table->id) }}" class="btn btn-primary">Edit</a>
            <a href="#" class="btn btn-danger" id="table-delete-btn">Delete</a>
            <form method="post" id="table-delete-form" action="{{ route('table.destroy', $table->id) }}">
              @csrf
              @method('delete')
            </form>
          </td>
        </tr>
        @endforeach
        @else
        <tr>
          <td>No data to be displayed</td>
        </tr>
        @endif
      </table>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
  document.getElementById('table-delete-btn').addEventListener('click', function() {
    event.preventDefault();
    if (confirm('Are you sure?')) {
      document.getElementById('table-delete-form').submit();
    }
  });

</script>
@endpush
