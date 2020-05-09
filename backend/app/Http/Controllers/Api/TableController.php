<?php

namespace App\Http\Controllers\Api;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Table;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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
    public function status(Request $request, Table $table)
    {
        $validator = Validator::make($request->all(), [
            'book_date' => 'required|date_format:Y-m-d',
            'book_time' => 'required|date_format:H:i:s'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ]);
        }
        $booking = $table->bookings()->where([
            'book_date' => $request->get('book_date'),
            'book_time' => $request->get('book_time')
        ])->first();
        if (is_null($booking)) {
            return response()->json([
                'free' => true
            ]);
        } else {
            return response()->json([
                'free' => false
            ]);
        }
    }
}
