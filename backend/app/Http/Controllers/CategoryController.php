<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Item;

class CategoryController extends Controller
{
    //

    public function index(){
            return view('category.index', [
                'categories' => Category::orderBy('created_at', 'desc')->get()
            ]);
        }

          public function create(){
            return view('category.create');
        }

        public function store(Request $req){

            $this->validate($req, [
                'title' => 'required',
                'description' => 'required'
            ]);

            $category = new Category([
                      'title'=> $req->input('title'),
                      'description'=>$req->input('description'),
                      'status' => 'true'
                      ]);
            $category->save();
            return view('category.index', [
                'categories' => Category::orderBy('created_at', 'desc')->get()
            ]);
        }

         public function edit($id){
            $category = Category::find($id);

            return view('category.edit',[
            'category' => $category
            ]);
         }

         public function changeStatusCategory($id){
            $category = Category::find($id);
            $category->status = !$category->status;
            $category->save();

            return view('category.index', [
                'categories' => Category::orderBy('created_at', 'desc')->get()
            ]);
         }

        public function update(Request $req){
            $this->validate($req, [
                'title' => 'required',
                'description' => 'required'
            ]);

            $category = Category::find($req->input('id'));

            $category->title = $req->input('title');
            $category->description = $req->input('description');
            $category->save();
            return view('category.index', [
                'categories' => Category::orderBy('created_at', 'desc')->get()
            ]);
        }

        public function destroy($id){
            $category = Category::find($id);

            $category->delete();
            return view('category.index', [
                'categories' => Category::orderBy('created_at', 'desc')->get()
            ]);
        }

}
