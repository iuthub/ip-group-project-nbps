@extends('layouts.main')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12 d-flex justify-content-between">
      <h3>{{ $user->name }}</h3>
      <div class="actions">
        <a href="{{ route('user.editPassword', $user->id) }}" class="btn btn-primary">Change password</a>
      </div>
    </div>
    <div class="col-md-12">
      <form action="{{ route('user.update', $user->id) }}" method="post">
        @csrf
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>
        <div class="form-group">
          <label>Firstname</label>
          <input type="text" name="firstname" class="form-control" value="{{ $user->profile->firstname }}">
        </div>
        <div class="form-group">
          <label>Lastname</label>
          <input type="text" name="lastname" class="form-control" value="{{ $user->profile->lastname }}">
        </div>
        <div class="form-group">
          <label>Birthday</label>
          <input type="date" name="birthday" class="form-control" value="{{ $user->profile->birthday }}">
        </div>
        <div class="form-group">
          <label>Phone</label>
          <input type="text" name="phone" class="form-control" value="{{ $user->profile->phone }}">
        </div>
        <div class="form-group">
          <label>Country</label>
          <input type="text" name="country" class="form-control" value="{{ $user->profile->country }}">
        </div>
        <div class="form-group">
          <label>City</label>
          <input type="text" name="city" class="form-control" value="{{ $user->profile->city }}">
        </div>
        <div class="form-group">
          <label>Postcode</label>
          <input type="text" name="postcode" class="form-control" value="{{ $user->profile->postcode }}">
        </div>
        <div class="form-group">
          <label>Address</label>
          <input type="text" name="address" class="form-control" value="{{ $user->profile->address }}">
        </div>
        @method('put')
        <input type="submit" value="Update" class="btn btn-success">
      </form>
    </div>
  </div>
</div>
@endsection
