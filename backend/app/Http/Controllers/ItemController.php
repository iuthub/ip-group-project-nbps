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
        return view('item.index', [
            'items' => Item::orderBy('created_at', 'desc')->get()
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

        $item = new Item;
        $item->title = $request->input('title');
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->category_id = $request->input('category_id');
        $item->image = Item::getDefaultPhotoURL();
        // $item->user_id = auth()->user()->id;
        $item->save();
        return redirect('/item')->with('success', 'Item created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return view('item.edit')->with('item', $item)->with('categories', Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required | numeric',
            'category_id' => 'required | numeric'
        ]);

        $item = Item::find($id);
        $item->title = $request->input('title');
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->category_id = $request->input('category_id');
        $item->image = Item::getDefaultPhotoURL();
        $item->save();
        return redirect('/item')->with('success', 'Item edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        return back()->with('success', 'Item deleted');
    }

    public function changeStatusItem($id){
         $item = Item::find($id);

         $item->status = !$item->status;
         $item->save();

         return view('item.index', [
            'items' => Item::orderBy('created_at', 'desc')->get()
         ]);
    }


}
