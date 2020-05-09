@extends('layouts.main')

@section('content')
<div class="card-body">
  <div class="d-flex justify-content-between">
    <h3>{{ $order->user->name }}'s order</h3>
    <a href="{{ route('order.index') }}" class="btn btn-primary">Back</a>
  </div>

  <div class="row mt-3">
    <div class="col-md-12">
      <table class="table table-stripped">
        <tr>
          <th>Item</th>
          <th>Quantity</th>
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
            <a href="" class="btn btn-primary">Edit</a>
            <a href="#" class="btn btn-danger" id='order-item-delete-btn'>Delete</a>
            <form method="post" action="{{ route('order-item.destroy', $orderItem->id) }}" id="order-item-delete-form">
              @csrf
              @method('delete')
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
@push('scripts')
<script>
  document.getElementById('order-item-delete-btn').addEventListener('click', function() {
    event.preventDefault();
    if (confirm('Are you sure?')) {
      document.getElementById('order-item-delete-form').submit()
    }
  });

</script>
@endpush
