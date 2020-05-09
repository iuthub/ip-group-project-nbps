@extends('layouts.main')

@section('content')
<div class="card-body">
  <div class="d-flex justify-content-between">
    <h3>Items</h3>
    <a href="{{ route('item.create') }}" class="btn btn-primary">Create item</a>
  </div>

  <div class="row mt-3">
    <div class="col-md-12">
      <table class="table table-stripped">
        <tr>
          <th>Title</th>
          <th>Category</th>
          <th>Description</th>
          <th>Price</th>
          <th>Status</th>
          <th width="200px">Actions</th>
        </tr>
        @if(count($items) > 0)
        @foreach ($items as $item)
        <tr>
          <td>{{ $item->title }}</td>
          <td>{{ $item->category->title }}</td>
          <td>{{ $item->description }}</td>
          <td>{{ $item->price }}</td>
          <td>{{ $item->status }}</td>
          <td>
            <a href="{{ route('item.edit', $item->id) }}" class="btn btn-secondary">Edit</a>
            <a href="#" class="btn btn-danger" id="item-delete-btn">Delete</a>
            <form method="post" id="item-delete-form" action="{{ route('item.destroy', $item->id) }}">
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
  document.getElementById('item-delete-btn').addEventListener('click', function() {
    event.preventDefault();
    if (confirm('Are you sure?')) {
      document.getElementById('item-delete-form').submit();
    }
  })

</script>
@endpush
