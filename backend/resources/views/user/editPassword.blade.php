@extends('layouts.main')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <form action="{{ route('user.updatePassword', $user->id) }}" method="post">
        @csrf
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
          <label>Confirm password</label>
          <input type="password" name="password_confirmation" class="form-control">
        </div>
        @method('put')
        <input type="submit" value="Update" class="btn btn-success">
      </form>
    </div>
  </div>
</div>
@endsection
