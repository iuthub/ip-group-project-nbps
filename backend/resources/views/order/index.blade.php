@extends('layouts.main')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between">
        <h3>Orders</h3>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <table class="table table-stripped">
                <tr>
                    <th>User name</th>
                    <th>Payment</th>
                    <th>Sum</th>
                    <th>Status</th>
                    <th colspan="3">Actions</th>
                    
                </tr>
                @if(count($orders) > 0)
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->payment_type }}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->status }}</td>
                    <td><a href="{{ route('order.show', $order->id) }}" class="btn btn-secondary">Show</a></td>
                    <td>
                        <form method="post" action="{{ route('order.destroy', $order->id) }}">
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
