@extends('layouts.main')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <form method="post" action="{{ route('item.update', $item->id) }}">
        <div class="form-group">
          @csrf
          <label>Title</label>
          <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $item->title }}" />
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control" name="description" rows="5">{{ $item->description }}</textarea>
        </div>
        <div class="form-group">
          <label>Price</label>
          <input type="text" class="form-control" name="price" placeholder="Price" value="{{$item->price}}" />
        </div>
        <div class="form-group">
          <label>Category</label>
          <select name="category_id" class="custom-select">
            @foreach ($categories as $category)
            @if($category->id == $item->category_id)
            <option value="{{$category->id}}" selected>{{$category->title}}</option>
            @else
            <option value="{{$category->id}}">{{$category->title}}</option>
            @endif
            @endforeach
          </select>
        </div>

        @method('put')
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('item.index') }}" class="btn btn-success">Back</a>
      </form>
    </div>
  </div>
</div>
@endsection
