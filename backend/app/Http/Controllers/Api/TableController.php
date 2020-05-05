<?php

namespace App\Http\Controllers\Api;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Table;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TableController extends Controller
{
    public function all()
    {
        return response()->json([
            'tables' => Table::all()
        ]);
    }

    public function details(Table $table)
    {
        return response()->json([
            'bookings' => $table->bookings
        ], Response::HTTP_OK);
    }
}
