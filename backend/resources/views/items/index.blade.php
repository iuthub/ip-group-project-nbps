@extends('layouts.main')

@section('content')
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <ul class="nav justify-content-end">
        <li><a href="/items/create" class="btn btn-primary">Create item</a></li>
    </ul>
    <h3>Items</h3>
    

    @if (count($items)>0)
        <table class="table table-stripped">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($items as $item)
                <tr>
                    <td>{{$item->title}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->image}}</td>
                    <td><a href="/items/{{$item->id}}/edit" class="btn btn-secondary">Edit</a></td>
                    <td>
                        <form method="post" action="{{ action('ItemController@destroy', $item->id)}}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </table>
    @else         
        <hr>               
        <p>No items were found</p>  
    @endif
</div>
@endsection

