<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function all()
    {
        return response()->json([
            'items' => Item::all()
        ]);
    }

    public function category(Item $item)
    {
        return response()->json([
            $item->category
        ]);
    }

    public function show(Item $item)
    {
        return response()->json([
            $item
        ]);
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
        $items = Item::where('title', 'like', "%{$request->get('title')}%")->get();

        return response()->json($items, 200);
    }
}
