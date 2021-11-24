<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function insert_ticket(Request $request){
        $newReservationData = json_decode($request->getContent());
        $newTicket = new Ticket();

        $newTicket->row = $newReservationData->row;
        $newTicket->col = $newReservationData->col;
        $newTicket->reservation_id = $newReservationData->reservation_id;

        $newTicket->save();
        return $newTicket;
    }
}
