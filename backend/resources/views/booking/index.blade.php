@extends('layouts.main')

@section('content')
<div class="card-body">
  <div class="d-flex justify-content-between">
    <h3>Bookings</h3>
    <a href="{{ route('booking.create') }}" class="btn btn-primary">Create booking</a>
  </div>

  <div class="row mt-3">
    <div class="col-md-12">
      <table class="table table-stripped">
        <tr>
          <th>User</th>
          <th>Table</th>
          <th>Book date</th>
          <th>Book time</th>
          <th>People count</th>
          <th>Actions</th>
        </tr>
        @if(count($bookings) > 0)
        @foreach ($bookings as $booking)
        <tr>
          <td>{{ $booking->user->name }}</td>
          <td>{{ $booking->table->number }}</td>
          <td>{{ $booking->book_date }}</td>
          <td>{{ $booking->book_time }}</td>
          <td>{{ $booking->people_count }}</td>
          <td>
            <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-primary">Edit</a>
            <a href="#" class="btn btn-danger" id="booking-delete-btn">Delete</a>
            <form method="post" id="booking-delete-form" action="{{ route('booking.destroy', $booking->id) }}">
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
  document.getElementById('booking-delete-btn').addEventListener('click', function() {
    event.preventDefault();
    if (confirm('Are you sure?')) {
      document.getElementById('booking-delete-form').submit();
    }
  });

</script>
@endpush
