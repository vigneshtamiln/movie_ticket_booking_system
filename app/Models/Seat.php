<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = [
        'seat_number',
        'show_id',
        // add other columns if needed
    ];

    // A seat belongs to a show
    public function show()
    {
        return $this->belongsTo(Show::class);
    }

    // A seat may have one booking
    public function booking()
    {
        return $this->hasOne(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
}
