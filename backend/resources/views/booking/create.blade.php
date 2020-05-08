@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('booking.store') }}">
                <div class="form-group">
                    @csrf
                    <label>User Name</label>
                    <select name="user_id" id="user_id" class="custom-select">
                        <option value="Select user"></option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Table Number</label>
                    <select name="table_id" id="table_id" class="custom-select">
                        <option value="Select table number"></option>
                        @foreach($tables as $table)
                            <option value="{{$table->id}}">{{$table->number}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>People count</label>
                    <input type="text" class="form-control" name="people_count"/>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" class="form-control" name="book_date"/>
                </div>
                <div class="form-group">
                    <label>Time</label>
                    <input type="time" class="form-control" name="book_time"/>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('booking.index') }}" class="btn btn-success">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
