@extends('layouts.main')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="d-flex justify-content-between">
        <h3>{{ $user->name }}</h3>
        <div class="actions">
          <a href="{{ route('user.editPassword', $user->id) }}" class="btn btn-primary">Change password</a>
          <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
          <a href="#" id="user-delete-btn" class="btn btn-danger">Delete</a>
          <form method="post" action="{{ route('user.destroy', $user->id) }}" id="user-delete-form">
            @csrf
            @method('delete')
          </form>
        </div>
      </div>
      <div class="col-md-12 mt-3 d-flex">
        <ul class="list-group w-50">
          <li class="list-group-item font-weight-bold">Name</li>
          <li class="list-group-item font-weight-bold">Email</li>
          <li class="list-group-item font-weight-bold">Firstname</li>
          <li class="list-group-item font-weight-bold">Lastname</li>
          <li class="list-group-item font-weight-bold">Phone</li>
          <li class="list-group-item font-weight-bold">Birthday</li>
          <li class="list-group-item font-weight-bold">Country</li>
          <li class="list-group-item font-weight-bold">City</li>
          <li class="list-group-item font-weight-bold">Postcode</li>
          <li class="list-group-item font-weight-bold">Address</li>
        </ul>
        <ul class="list-group w-50">
          <li class="list-group-item">{{ $user->name }}</li>
          <li class="list-group-item">{{ $user->email }}</li>
          <li class="list-group-item">{{ $user->profile->firstname ?? 'undefined' }}</li>
          <li class="list-group-item">{{ $user->profile->lastname ?? 'undefined'}}</li>
          <li class="list-group-item">{{ $user->profile->phone ?? 'undefined'}}</li>
          <li class="list-group-item">{{ $user->profile->birthday ?? 'undefined'}}</li>
          <li class="list-group-item">{{ $user->profile->country ?? 'undefined'}}</li>
          <li class="list-group-item">{{ $user->profile->city ?? 'undefined'}}</li>
          <li class="list-group-item">{{ $user->profile->postcode ?? 'undefined'}}</li>
          <li class="list-group-item">{{ $user->profile->address ?? 'undefined'}}</li>
        </ul>
      </div>
    </div>
  </div>
  @endsection
  @push('scripts')
  <script>
    document.getElementById('user-delete-btn').addEventListener('click', function() {
      if (confirm('Are you sure?')) {
        document.getElementById('user-delete-form').submit();
      }
    });

  </script>
  @endpush
