@extends('layouts.main')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3>Create user</h3>
    </div>
    <div class="col-md-12">
      <form action="{{ route('user.store') }}" method="post">
        @csrf
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" placeholder="">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
          <label>Confirm password</label>
          <input type="password" name="password_confirmation" class="form-control">
        </div>
        <div class="form-group">
          <label>Firstname</label>
          <input type="password" name="firstname" class="form-control">
        </div>
        <div class="form-group">
          <label>Lastname</label>
          <input type="password" name="lastname" class="form-control">
        </div>
        <div class="form-group form-check">
          <input type="checkbox" name="admin_role" class="form-check-input">
          <label class="form-check-label">Administrator</label>
        </div>
        <input type="submit" value="Create" class="btn btn-success">
      </form>
    </div>
  </div>
</div>
@endsection
