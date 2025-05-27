<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Show;
use App\Models\Seat;

class ShowController extends Controller
{
    /**
     * Display a listing of the shows.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $shows = Show::all();
        return view('shows.index', compact('shows'));

    }
    /**
     * Display the booking form for a specific show.
     *
     * @param int $showId
     * @return \Illuminate\View\View
     */
    public function book($showId)
    {
        $show = Show::findOrFail($showId);
        $seats = Seat::where('show_id', $show->id)->get();
        
        return view('shows.book', compact('show', 'seats'));
    }

}
