<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seat;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display the booking form for a specific show.
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $request->validate([
            'seat_ids' => 'required|array|min:1',
        ], [
            'seat_ids.required' => 'Please select at least 1 seat.',
            'seat_ids.min' => 'Please select at least 1 seat.',
            'seat_ids.array' => 'Invalid seat selection.',
        ]);


        foreach ($request->seat_ids as $id) {
            $seat = Seat::where('id', $id)->where('is_booked', false)->first();
            if ($seat) {
                $seat->is_booked = true;
                $seat->user_id = Auth::id();
                $seat->save();
            }
        }

        return response()->json(['message' => 'Booking successful']);
    }

}
