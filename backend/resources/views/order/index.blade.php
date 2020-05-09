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
          <th>Total</th>
          <th>Status</th>
          <th colspan="2">Actions</th>

        </tr>
        @if(count($orders) > 0)
        @foreach ($orders as $order)
        <tr>
          <td>{{ $order->user->name }}</td>
          <td>{{ $order->payment_type }}</td>
          <td>{{ $order->total }}</td>
          <td>{{ $order->status }}</td>
          <td colspan="2">
            <a href="{{ route('order.show', $order->id) }}" class="btn btn-secondary">Show</a>
            <a href="#" class="btn btn-danger" id="order-delete-btn">Delete</a>
            <form method="post" id="delete-order-form" action="{{ route('order.destroy', $order->id) }}">
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
  document.getElementById('order-delete-btn').addEventListener('click', function() {
    event.preventDefault();
    if (confirm('Are you sure?')) {
      document.getElementById('delete-order-form').submit()
    }
  });

</script>
@endpush
