<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Show;
use App\Models\Seat;

class ShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        $show = Show::create([
            'date' => now()->toDateString(),
            'time' => '18:00:00',
        ]);

        foreach (range(1, 20) as $i) {
            Seat::create([
                'seat_number' => 'A'.$i,
                'show_id' => $show->id,
            ]);
        }
    }

}
