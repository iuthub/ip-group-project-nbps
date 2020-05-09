@extends('layouts.main')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <form method="post" action="{{ route('table.update', $table->id) }}">
        <div class="form-group">
          @csrf
          <label>Number</label>
          <input type="text" class="form-control" name="number" placeholder="Number" value="{{ $table->number }}" />
        </div>
        <div class="form-group">
          <label>Number of People</label>
          <input type="text" class="form-control" name="people_count" placeholder="Number of People" value="{{ $table->people_count }}" />
        </div>
        <div class="form-group">
          <label>Min deposit</label>
          <input type="text" class="form-control" name="min_deposit" placeholder="Min deposit" value="{{$table->min_deposit}}" />
        </div>

        <input type="hidden" name="id" value="{{ $table->id }}">
        @method('put')
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ url()->previous() }}" class="btn btn-success">Back</a>
      </form>
    </div>
  </div>
</div>
@endsection
