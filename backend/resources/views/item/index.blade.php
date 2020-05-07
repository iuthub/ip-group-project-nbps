@extends('layouts.main')

@section('content')
<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

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
                    <th colspan="3">Actions</th>
                </tr>
                @if(count($items) > 0)
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->category->title }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->image }}</td>
                    <td><a href="{{ route('item.edit', $item->id) }}" class="btn btn-secondary">Edit</a></td>
                    <td>
                        <form method="post" action="{{ route('item.destroy', $item->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
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
