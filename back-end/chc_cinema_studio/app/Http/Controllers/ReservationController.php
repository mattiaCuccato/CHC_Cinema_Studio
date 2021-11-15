<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ReservationController extends Controller
{
    public function insert_reservation(Request $request){
        $data = json_decode($request->getContent());

        Log::info(json_encode($data, JSON_PRETTY_PRINT));

        $newReservation = new Reservation();
        $newReservation->email = $data->email;
        $newReservation->name_user = $data->name_user;
        $newReservation->surname_user = $data->surname_user;
        $newReservation->projection_id = $data->projection_id;
        
        $newReservation->save();

        foreach($data->tickets as $ticket){
            Log::info("qualcosa");
            $newTicket = new Ticket();
            $newTicket->row = $ticket->row;
            $newTicket->col = $ticket->col;
            $newTicket->reservation_id = $newReservation->id;
            $newTicket->save();
        }


        /*$newTicket = new Ticket();
        $newTicket->reservation_id = $newReservation->id;
        $newTicket->row = $data->row;
        $newTicket->col = $data->col;
        $newTicket->save();*/
        return Reservation::with(["tickets"])->get();
    }

    public function view_reservation(){
        return Reservation::with(["tickets", "projection.film", "projection.room"])->get();
    }
}
