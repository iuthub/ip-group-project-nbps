@extends('layouts.main')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="d-flex justify-content-between">
        <h3>Users</h3>
        <a href="{{ route('user.create') }}" class="btn btn-success">Create user</a>
      </div>
      <div class="col-md-12 mt-3">
        <table class="table table-stripped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Fullname</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->profile->firstname}}</td>
              <td>{{ $user->profile->address }}</td>
              <td>{{ $user->profile->phone }}</td>
              <td>
                <a href="{{ route('user.show', $user->id) }}" class="btn btn-primary">Show</a>
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                <a href="#" class="btn btn-danger" id="user-delete-btn">Delete</a>
                <form action="{{ route('user.destroy', $user->id) }}" id="user-delete-form">
                  @csrf
                  @method('delete')
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
  document.getElementById('user-delete-btn').addEventListener('click', function() {
    event.preventDefault();
    if (confirm('Are you sure?')) {
      document.getElementById('user-delete-form').submit();
    }
  });

</script>
@endpush
