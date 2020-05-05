<?php

namespace App\Http\Controllers\Api;

use App\Table;
use App\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookTableFormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{

    protected $hidden = [
        'user_id'
    ];

    public function all()
    {
        $user = Auth::guard('api')->user();
        return response()->json($user->bookings()->with('table')->get());
    }

    public function book(BookTableFormRequest $request, Table $table)
    {
        if ($request->get('people_count') > $table->people_count) {
            return response()->json([
                'message' => 'People count is bigger than the threshold'
            ]);
        }
        $user = Auth::guard('api')->user();
        if (!$user->bookings()->create(array_merge($request->all(), [
            'table_id' => $table->id
        ]))) {
            return response()->json([
                'message' => 'Unable to perform action'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return response()->json([
            'message' => 'Booking has been saved'
        ], Response::HTTP_OK);
    }
}
