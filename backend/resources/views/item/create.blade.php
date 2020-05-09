@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ action('ItemController@store') }}">
                <div class="form-group">
                    @csrf
                    <label>Name</label>
                    <input type="text" class="form-control" name="title" placeholder="Name" />
                    @error('title')
                    <small id="emailHelp" class="form-text text-danger">We'll never share your email with anyone else.</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" rows="5" placeholder="Description"></textarea>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" class="form-control" name="price" placeholder="Price" />
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="custom-select">
                        <option>Select category</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ url()->previous() }}" class="btn btn-success">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection