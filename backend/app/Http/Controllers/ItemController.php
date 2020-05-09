<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('created_at', 'desc')->get();
        return view('item.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('item.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric'
        ]);

        $item = Item::create(array_merge($request->all(), [
            'image' => Item::getDefaultPhotoURL()
        ]));
        return redirect()->rotue('item.index')->with([
            'success' => __('flash.success.store', ['model' => 'Item'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('item.edit', [
            'item' => $item,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
        ]);
        $item->update(array_merge($request->all(), [
            'image' => Item::getDefaultPhotoURL()
        ]));
        return redirect()->route('item.index')->with([
            'success' => __('flash.success.update', ['model' => 'Item'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('item.index')->with([
            'success' => __('flash.success.destroy', ['model' => 'Item'])
        ]);
    }

    public function changeStatusItem($id)
    {
        $item = Item::find($id);

        $item->status = !$item->status;
        $item->save();

        return view('item.index', [
            'items' => Item::orderBy('created_at', 'desc')->get()
        ]);
    }
}
