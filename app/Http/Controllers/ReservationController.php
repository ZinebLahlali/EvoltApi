<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index'])
        ];
    }
    public function index()
    {
        return Reservation::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $request->user();
         $fields = $request->validate([
            'borne_id' => 'required',
            'date' => 'required|date',
            'heure' => 'required',
        ]);
          
          
         $reservation = $request->user()->reservations()->create($fields);
          return $reservation;
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return $request->user()->reservation()->with('borne')->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        
         $fields = $request->validate([
            'borne_id' => 'required',
            'date' => 'required|date',
            'heure' => 'required',
        ]);
          
        $reservation->update($fields);
        return $reservation;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return ["message" => "La réservation a été supprimée."];
    }


    public function changeStatus(Request $request, $id)
    {
        $reservation = Reservation::where("id", $id)->where("status", "pending")->update([
            'status' => $request->status
        ]);

        if(!$reservation){
            return Response()->json([
                "message" => "Reservation Not Found"
            ]);
        }
        return Response()->json([
            "message" => "Status a été changée"
        ]);
    }
}
