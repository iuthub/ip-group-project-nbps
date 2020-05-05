<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OrderStoreFormRequest;
use App\Http\Requests\OrderUpdateFormRequest;
use App\User;

class OrderController extends Controller
{
    public function all()
    {
        $user = Auth::guard('api')->user();
        return response()->json([
            'orders' => Order::where('user_id', $user->id)->with('items')->get()
        ], Response::HTTP_OK);
    }

    public function show(Request $request, Order $order)
    {
        return response()->json($order, Response::HTTP_OK);
    }

    public function store(OrderStoreFormRequest $request)
    {
        $user = Auth::guard('api')->user();
        $order = $user->orders()->create([
            'payment_type' => $request->get('payment_type'),
        ]);
        $items = $request->get('items');
        foreach ($items as $item) {
            $order->orderItems()->create([
                'item_id' => $item['id'],
                'quantity' => $item['quantity'],
            ]);
        }
        return response()->json([
            'message' => 'Order has been saved'
        ]);
    }
}
