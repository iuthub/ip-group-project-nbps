@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ action('CategoryController@store') }}">
                <div class="form-group">
                    @csrf
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title" />
                    @error('title')
                    <small id="emailHelp" class="form-text text-danger">We will never share your email with anyone else.</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" rows="5" placeholder="Description"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ url()->previous() }}" class="btn btn-success">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
