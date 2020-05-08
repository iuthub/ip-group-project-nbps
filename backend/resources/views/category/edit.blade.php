@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('category.update', $category->id) }}">
                <div class="form-group">
                    @csrf
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $category->title }}" />
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" rows="5">{{ $category->description }}</textarea>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <input type="text" class="form-control" name="price" placeholder="Price" value="{{$category->status}}" />
                </div>
                <input type="hidden" name="id" value="{{ $category->id }}">
                @method('put')
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ url()->previous() }}" class="btn btn-success">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
