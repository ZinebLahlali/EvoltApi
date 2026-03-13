<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
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
        $reservation = Reservation::where('user_id', auth()->id())->get();
        return  $reservation;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'borne_id' => 'required',
            'date' => 'required|date',
            'heure' => 'required',
        ]);
        $fields['user_id'] = auth()->user()->id;


        $reservation = Reservation::create($fields);
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
        //return auth()->user()->id;

        if($reservation->user_id === auth()->user()->id){
            $reservation->delete();
            return ["message" => "La réservation a été supprimée."];
        }
        return ["message" => "The resevation don't belong to you."];
    }


    public function changeStatus($id)
    {
        $reservation = Reservation::findOrFail($id);
         if($reservation->user_id === auth()->user()->id){
        if ($reservation->status == 'pending') {
            Reservation::where('id', $id)->where('status', 'pending')
                ->update(['status' => 'confirmed']);
        } elseif ($reservation->status == 'confirmed') {
            Reservation::where('id', $id)->where('status', 'confirmed')
                ->update(['status' => 'completed']);
        } else {
            return response()->json([
                'message' => 'Reservation déjà terminée'
            ], 400);
        }
        return response()->json([
            'message' => 'Status a été changée'
        ]);
    }
      return ["message" => "The reservation don't belong to you."];
    }


    public function annuleReservation($id)
    {    $reservation = Reservation::findOrFail($id);
        if($reservation->user_id === auth()->user()->id){
        if($reservation->status === 'cancelled'){
        return ["message" => "the reservation is already cancelled"];
      }
            $reservation->status = 'cancelled';
            $reservation->save();
             return ["message" => "The reservation is cancelled"];
         }

          return ["message" => "The reservation is not yours"];
        
}

}
