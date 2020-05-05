<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function all(Request $request)
    {
        return response()->json([
            'categories' => Category::all()
        ], Response::HTTP_OK);
    }

    public function items(Request $request, Category $category)
    {
        return response()->json([
            'category' => $category,
            'items' => $category->items
        ], Response::HTTP_OK);
    }

    public function show(Request $request, Category $category)
    {
        return response()->json($category, Response::HTTP_OK);
    }
}
