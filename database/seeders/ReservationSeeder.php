<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Screening;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('role', 'visitor')->first();
        $screening = Screening::first();

        if ($user && $screening) {
            Reservation::create([
                'screening_id' => $screening->id,
                'user_id' => $user->id,
                'reserved_tickets' => 2,
                'status' => 'placed'
            ]);
        }
    }
}
