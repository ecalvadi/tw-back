<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $returnPosition = Position::where('user_id', auth()->id())->firstOr(function () {
            $position = new Position();
            $position->lat = request()->lat;
            $position->lon = request()->lon;
            $position->user_id = auth()->id();
            $position->save();

            return $position;
        });

        return response()->json($returnPosition, 201);
    }

    /**
     * Display the specified resource.
     */
    public function byUser(Request $request)
    {
        $userId = auth()->id();
        $returnPosition = Position::where('user_id', $userId)->firstOr(function(){
            $position = new Position();
            return $position;
        });
        return response()->json($returnPosition);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $position = Position::find($request->id)->first();

        $position->lat = $request->lat;
        $position->lon = $request->lon;
        $position->save();

        return response()->json($position);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Position $position)
    {
        //
    }
}
