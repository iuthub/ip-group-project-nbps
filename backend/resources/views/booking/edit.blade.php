@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('booking.update', $booking->id) }}">
                @csrf
                <div class="form-group">
                    <label>User name</label>
                    <select name="user_id" class="custom-select">
                        @foreach ($users as $user)
                        @if($user->id == $booking->user_id)
                        <option value="{{$user->id}}" selected>{{$user->name}}</option>
                        @else
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Table number</label>
                    <select name="table_id" class="custom-select">
                        @foreach ($tables as $table)
                        @if($table->id == $booking->table_id)
                        <option value="{{$table->id}}" selected>{{$table->number}}</option>
                        @else
                        <option value="{{$table->id}}">{{$table->number}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>People count</label>
                <input type="text" class="form-control" name="people_count" value="{{$booking->people_count}}"/>
                </div>
                <div class="form-group">
                    <label>Date</label>
                <input type="date" class="form-control" name="book_date" value="{{$booking->book_date}}"/>
                </div>
                <div class="form-group">
                    <label>Time</label>
                <input type="time" class="form-control" name="book_time" value="{{$booking->book_time}}"/>
                </div>

                @method('put')
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('booking.index') }}" class="btn btn-success">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
