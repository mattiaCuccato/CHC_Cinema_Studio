<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function insert_room(Request $request){
        $dati = json_decode($request->getContent());
        $room = new Room();

        $room->name = $dati->name;
        $room->rows = $dati->rows;
        $room->cols = $dati->cols;
        $room->max_seats = $dati->max_seats;

        $room->save();
        return $room;
    }

    public function view_room(){
        $allRoom = new Room();
        return $allRoom->all();
    }
}
