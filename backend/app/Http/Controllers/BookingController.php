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
            'people_count' => 'required|numeric'
        ]);

        $booking = new Booking;
        $booking->user_id = $request->input('user_id');
        $booking->table_id = $request->input('table_id');
        $booking->book_date = $request->input('book_date');
        $booking->book_time = $request->input('book_time');
        $booking->people_count = $request->input('people_count');
        // $booking->user_id = auth()->user()->id;
        $booking->save();
        return redirect()->route('booking.index')->with('success', 'Booking created');
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
        return view('booking.edit')
                ->with('booking', $booking)
                ->with('users', User::all())
                ->with('tables', Table::all());
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
            'people_count' => 'required|numeric'
        ]);

        $booking = Booking::find($id);
        $booking->user_id = $request->input('user_id');
        $booking->table_id = $request->input('table_id');
        $booking->book_date = $request->input('book_date');
        $booking->book_time = $request->input('book_time');
        $booking->people_count = $request->input('people_count');


        $booking->save();


        return redirect()->route('booking.index')->with('success', 'Booking edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::find($id);
        $booking->delete();
        return redirect()->route('booking.index')->with('success', 'Booking deleted');
    }
}
