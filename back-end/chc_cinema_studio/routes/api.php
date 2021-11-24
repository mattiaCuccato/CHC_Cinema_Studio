<?php

use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ProjectionController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/film/create",[FilmController::class,"create_film"]);
Route::get("/films",[FilmController::class,"view_film"]);
Route::get("/film/detail/{id}",[FilmController::class,"film_detail"]);

Route::post('/room/create', [RoomController::class,"insert_room"]);
Route::get("/rooms",[RoomController::class,"view_room"]);

Route::post("/projection/create",[ProjectionController::class,"create_projection"]);
Route::get("/film/projections",[ProjectionController::class,"view_projections"]);
Route::get("/projection/{id}",[ProjectionController::class,"view_tickets_projection"]);

Route::post('/reservation/create', [ReservationController::class,"insert_reservation"]);
Route::get("/reservations",[ReservationController::class,"view_allReservation"]);
Route::get("/reservation/{id}",[ReservationController::class,"view_reservation_byId"]);
