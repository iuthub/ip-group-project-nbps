@extends('layouts.main')

@section('content')
<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <div class="d-flex justify-content-between">
        <h3>Bookings</h3>
        <a href="{{ route('booking.create') }}" class="btn btn-primary">Create booking</a>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <table class="table table-stripped">
                <tr>
                    <th>User ID</th>
                    <th>Table ID</th>
                    <th>Book date</th>
                    <th>Book time</th>
                    <th>People count</th>
                    <th colspan="3">Actions</th>
                </tr>
                @if(count($bookings) > 0)
                @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->table->number }}</td>
                    <td>{{ $booking->book_date }}</td>
                    <td>{{ $booking->book_time }}</td>
                    <td>{{ $booking->people_count }}</td>
                    <td><a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-secondary">Edit</a></td>
                    <td>
                        <form method="post" action="{{ route('booking.destroy', $booking->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
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
