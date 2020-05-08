@extends('layouts.main')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between">
        <h3>{{ $order }}'s order</h3>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <table class="table table-stripped">
                <tr>
                    <th>Item name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th colspan="3">Actions</th>
                    
                </tr>
                @if(count($orderItems) > 0)
                @foreach ($orderItems as $orderItem)
                <tr>
                    <td>{{ $orderItem->item->title }}</td>
                    <td>{{ $orderItem->quantity }}</td>
                    <td>{{ $orderItem->item->price }}</td>
                    <td>{{ $orderItem->total }}</td>
                    <td>
                        <form method="post" action="{{ route('orderItem.destroy', $orderItem->id) }}">
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
