<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderItem;
use App\Order;

class OrderItemController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orderItem = OrderItem::find($id);
        $orderItem->delete();
        return redirect('/order')->with('success', 'Order\'s item deleted');
    }
}
