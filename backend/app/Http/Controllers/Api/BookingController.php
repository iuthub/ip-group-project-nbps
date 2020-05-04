<?php

namespace App\Http\Controllers\Api;

use App\Table;
use App\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{

    public function all()
    {
        $user = Auth::guard('api')->user();
        return response()->json($user->bookings()->with('table'));
    }

    public function book(Request $request, Table $id)
    {
        $user = Auth::guard('api')->user();
        $validator = Validator::make($request->all(), Booking::rules());
        
    }
}
