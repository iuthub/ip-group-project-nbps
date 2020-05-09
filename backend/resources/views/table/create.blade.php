@extends('layouts.main')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <form method="post" action="{{ action('TableController@store') }}">
        <div class="form-group">
          @csrf
          <label>Number</label>
          <input type="text" class="form-control" name="number" placeholder="Number" />
        </div>
        <div class="form-group">
          <label>Number of people</label>
          <input type="text" class="form-control" name="people_count" placeholder="Number of people" />
        </div>
        <div class="form-group">
          <label>Min deposit</label>
          <input type="text" class="form-control" name="min_deposit" placeholder="Min deposit" />
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ url()->previous() }}" class="btn btn-success">Back</a>
      </form>
    </div>
  </div>
</div>
@endsection
