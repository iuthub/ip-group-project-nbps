@extends('layouts.main')

@section('content')
    <h1>Edit the item</h1>

    
    <form method="post" action="{{ route('items.update', $item->id)}}">
        <div class="form-group">
            @csrf            
            <label>Title</label>
            <input type="text" class="form-control" name="title" placeholder="Title" value="{{$item->title}}"/>
        </div>
        <div class="form-group">          
            <label>Description</label>
            <input type="text" class="form-control" name="description" placeholder="Description" value="{{$item->description}}"/>
        </div>
        <div class="form-group">            
            <label>Price</label>
            <input type="text" class="form-control" name="price" placeholder="Price" value="{{$item->price}}"/>
        </div>
        <div class="form-group">           
            <label>Category</label>
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
        </div>

        @method('put')
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection