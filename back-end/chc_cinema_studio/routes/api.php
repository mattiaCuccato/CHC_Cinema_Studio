<?php

use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

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

Route::post('/room/create', [RoomController::class,"insert_room"]);
Route::get("/rooms",[RoomController::class,"view_room"]);

Route::post("/projection/create",[ProjectionController::class,"create_projection"]);
Route::get("/projections",[ProjectionController::class,"view_projections"]);

