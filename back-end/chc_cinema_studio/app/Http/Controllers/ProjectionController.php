<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Projection;
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

    public function view_projections($film_id){
        $allProjections = Projection::all();
        return $allProjections->where("film_id", $film_id);
    }
}
