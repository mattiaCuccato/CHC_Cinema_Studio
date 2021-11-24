<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Projection;
use App\Models\Room;
use Illuminate\Http\Request;

class ProjectionController extends Controller
{
    public function create_projection(Request $request) {

        $newProjectionData = json_decode($request->getContent());
        $newProjection = new Projection();

        $newProjection-> film_id = $newProjectionData->film_id;
        $newProjection-> room_id = $newProjectionData->room_id;
        $newProjection-> date = $newProjectionData->date;

        $newProjection->save();
        return $newProjection;
    }

    // public function create_projection($film_id, $room_id, Request $request)
    // {
    //     $newProjectionData = json_decode($request->getContent());
    //     $newProjection = new Projection();

    //     $newProjection->film_id = $film_id;
    //     $newProjection->room_id = $room_id;
    //     $newProjection->date = $newProjectionData->date;

    //     $newProjection->save();
    //     return $newProjection;
    // }

    // public function create_projection(Request $request){
    //     $newProjectionData = json_decode($request->getContent());
    //     $newProjection = new Projection();

    //     $film = Film::all()->where("id",$newProjectionData->film_id);
    //     $room = Room::all()->where("id",$newProjectionData->room_id);

    //     $newProjection->film_id = $film;
    //     $newProjection->room_id = $room;
    //     $newProjection->date = $newProjectionData->date;

    //     $newProjection->save();
    // }

    public function view_projections()
    {
        return Film::with(["projections", "projections.room"])->get();
    }

    public function view_tickets_projection($id)
    {
        return Projection::with(["tickets", "room", "film"])->where("id", $id)->first();
    }
}
