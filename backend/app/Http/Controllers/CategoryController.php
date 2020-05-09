<?php

namespace App\Http\Controllers;

use App\Item;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index', [
            'categories' => Category::orderBy('created_at', 'desc')->get()
        ]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $category = Category::create($request->all());
        return redirect()->route('category.index')->with([
            'success' => __('flash.success.store', ['model' => 'Category'])
        ]);
    }

    public function edit(Category $category)
    {
        return view('category.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
        $category->update($request->all());
        return redirect()->route('category.index')->with([
            'success' => __('flash.success.update', ['model' => 'Category'])
        ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with([
            'success' => __('flash.success.destroy', ['model' => 'Category'])
        ]);
    }
}
