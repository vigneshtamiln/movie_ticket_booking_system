<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;

    protected $fillable = [
        'show_date',
        'show_time', // or 'datetime' depending on your implementation
    ];

    /**
     * Get the seats associated with the show.
     */
    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    /**
     * Get the bookings for the show.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
