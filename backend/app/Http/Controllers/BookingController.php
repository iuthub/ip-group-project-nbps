<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\User;
use App\Table;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->get();
        return view('booking.index', [
            'bookings' => $bookings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $tables = Table::all();
        return view('booking.create', [
            'users' => $users,
            'tables' => $tables
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
            'user_id' => 'required|numeric',
            'people_count' => 'required|numeric',
            'table_id' => 'required|numeric',
            'book_date' => 'date_format:Y-m-d',
            'book_time' => 'date_format:H:i'
        ]);

        $booking = new Booking($request->all());
        $booking->save();
        return redirect()->route('booking.index')->with([
            'success' => __('flash.success.store', ['model' => 'Booking'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = Booking::find($id);
        $users = User::all();
        $tables = Table::all();
        return view('booking.edit', [
            'booking' => $booking,
            'users' => $users,
            'tables' => $tables
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $this->validate($request, [
            'user_id' => 'required|numeric',
            'people_count' => 'required|numeric',
            'table_id' => 'required|numeric',
            'book_date' => 'date_format:Y-m-d',
            'book_time' => 'date_format:H:i'
        ]);

        $booking->update($request->all());
        return redirect()->route('booking.index')->with([
            'success' => __('flash.success.update', ['model' => 'Booking'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('booking.index')->with([
            'success' => __('flash.success.destroy', ['model' => 'Booking'])
        ]);
    }
}
