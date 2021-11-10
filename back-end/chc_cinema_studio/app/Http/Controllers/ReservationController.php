<?php

namespace App\Http\Controllers;

use App\Models\Projection;
use App\Models\Reservation;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ReservationController extends Controller
{
    public function insert_reservation(Request $request){
        $newReservationData = json_decode($request->getContent());

        $newReservation = new Reservation();
        $projection = new Projection();
        $newReservation->email = $newReservationData->email;
        $newReservation->projection_id = [
            $projection->date = $newReservationData->date,
        ];
        $newReservation->save();
        return $newReservation;
    }
}
