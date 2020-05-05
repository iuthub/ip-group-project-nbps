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
}
