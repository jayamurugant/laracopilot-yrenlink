<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        // Create booking record (in real app, save to database)
        $booking = [
            'id' => rand(1000, 9999),
            'user_id' => session('user')['id'],
            'listing_id' => $request->listing_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_amount' => $request->total_amount,
            'status' => 'pending',
            'created_at' => now()
        ];

        session(['pending_booking' => $booking]);

        return redirect()->route('booking.payment', ['id' => $booking['id']]);
    }

    public function payment($id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        $booking = session('pending_booking');
        if (!$booking || $booking['id'] != $id) {
            return redirect()->route('enduser.dashboard')->with('error', 'Booking not found');
        }

        return view('booking.payment', compact('booking'));
    }
}