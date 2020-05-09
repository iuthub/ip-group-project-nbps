<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Table;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::orderBy('created_at', 'desc')->get();
        return view('table.index', [
            'tables' => $tables
        ]);
    }

    public function create()
    {
        return view('table.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'number' => 'required|numeric|unique:tables',
            'people_count' => 'required|numeric',
            'min_deposit' => 'required|numeric'
        ]);

        $table = Table::create($request->all());
        return redirect()->route('table.index')->with([
            'success' => __('flash.success.store', ['model' => 'Table'])
        ]);
    }

    public function edit(Table $table)
    {
        return view('table.edit', [
            'table' => $table
        ]);
    }

    public function update(Request $request, Table $table)
    {
        $this->validate($request, [
            'number' => [
                'required',
                'numeric',
                Rule::unique('tables')->ignore($table->id)
            ],
            'people_count' => 'required|numeric',
            'min_deposit' => 'required|numeric'
        ]);

        $table->update($request->all());
        return redirect()->route('table.index')->with([
            'success' => 'flash'
        ]);
    }


    public function destroy(Table $table)
    {
        $table->delete();
        return redirect()->route('table.index')->with([
            'success' => __('flash.success.destroy', ['model' => 'Table'])
        ]);
    }
}
