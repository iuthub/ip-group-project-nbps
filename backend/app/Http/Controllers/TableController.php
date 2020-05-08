<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Table;


class TableController extends Controller
{
    //



      public function index(){
            return view('table.index', [
                'tables' => Table::orderBy('created_at', 'desc')->get()
            ]);
        }

        public function create(){
            return view('table.create');
        }

        public function store(Request $req){
            $this->validate($req, [
                'number' => 'required|numeric',
                'people_count' => 'required|numeric',
                'min_deposit' => 'required|numeric'
            ]);

            $table = new Table([
                      'number'=> $req->input('number'),
                      'people_count'=>$req->input('people_count'),
                      'min_deposit' => $req->input('min_deposit')
                      ]);
            $table->save();
            return view('table.index', [
                'tables' => Table::orderBy('created_at', 'desc')->get()
            ]);
        }

         public function edit($id){
            $table = Table::find($id);

            return view('table.edit',[
            'table' => $table
            ]);
         }

        public function update(Request $req){
            $this->validate($req, [
                'number' => 'required|numeric',
                'people_count' => 'required|numeric',
                'min_deposit' => 'required|numeric'
            ]);

            $table = Table::find($req->input('id'));

            $table->number = $req->input('number');
            $table->people_count = $req->input('people_count');
            $table->min_deposit = $req->input('min_deposit');
            $table->save();

            return view('table.index', [
                'tables' => Table::orderBy('created_at', 'desc')->get()
            ]);
        }


        public function destroy($id){
            $table = Table::find($id);

            $table->delete();
            return view('table.index', [
                'tables' => Table::orderBy('created_at', 'desc')->get()
            ]);
        }

}
