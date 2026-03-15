<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;


class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total' => Reservation::count(),
            'payee' => Reservation::where('status', 'completed')->count(),
            'en_cours' => Reservation::where('status', 'pending')->count(),
        ];

       $lastReservations = Reservation::with(['users', 'borne'])->latest()->take(10)->get(); 

       return response()->json([
         'stats' => $stats,
         'last_reservations' => $lastReservations
       ]);
    }
}
