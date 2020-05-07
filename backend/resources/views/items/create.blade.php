@extends('layouts.main')

@section('content')
    <h1>Create the item</h1>


    
    <form method="post" action="{{ action('ItemController@store') }}">
        <div class="form-group">
            @csrf            
            <label>Name</label>
            <input type="text" class="form-control" name="title" placeholder="Name"/>
        </div>
        <div class="form-group">          
            <label>Description</label>
            <input type="text" class="form-control" name="description" placeholder="Description"/>
        </div>
        <div class="form-group">           
            <label>Price</label>
            <input type="text" class="form-control" name="price" placeholder="Price"/>
        </div>
        <div class="form-group">           
            <label>Category</label>
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>

@endsection