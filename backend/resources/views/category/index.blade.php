@extends('layouts.main')

@section('content')
<div class="card-body">
  @if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
  @endif

  <div class="d-flex justify-content-between">
    <h3>Categories</h3>
    <a href="{{ route('category.create') }}" class="btn btn-primary">Create item</a>
  </div>

  <div class="row mt-3">
    <div class="col-md-12">
      <table class="table table-stripped">
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th>Status</th>
          <th width="15%">Actions</th>
        </tr>
        @if(count($categories) > 0)
        @foreach ($categories as $category)
        <tr>
          <td>{{ $category->title }}</td>
          <td>{{ $category->description }}</td>
          <td>{{ $category->status }}</td>
          <td>
            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-secondary">Edit</a>
            <a href="#" class="btn btn-danger" id="category-delete-btn">Delete</a>
            <form method="post" action="{{ route('category.destroy', $category->id) }}" id="category-delete-form">
              @csrf
              @method('delete')
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
@push('scripts')
<script>
  document.getElementById('category-delete-btn').addEventListener('click', function() {
    event.preventDefault();
    if (confirm('Are you sure?')) {
      document.getElementById('category-delete-form').submit();
    }
  });

</script>
@endpush
