<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ReservationController extends Controller
{
    public function insert_reservation(Request $request){
        $newReservationData = json_decode($request->getContent());

        $newReservation = new Reservation();
        

        $newReservation->save();
        return $newReservation;
    }
}
