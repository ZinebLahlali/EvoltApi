<?php

namespace App\Http\Controllers;

use App\Models\Borne;
use Illuminate\Http\Request;

class BorneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Borne::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'connector_type' => 'required|string|in:Type2,CCS,CHAdeMo',
            'is_available' => 'required|boolean'
        ]);
        return 'ok';
    }

    /**
     * Display the specified resource.
     */
    public function show(Borne $borne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Borne $borne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borne $borne)
    {
        //
    }
}
