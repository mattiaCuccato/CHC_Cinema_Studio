<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;

class FilmController extends Controller
{
    public function create_film(Request $request) {
        $newFilmData = json_decode($request->getContent());

        $newFilm = new Film();
        $newFilm -> title = $newFilmData -> title;
        $newFilm -> poster = $newFilmData -> poster;
        $newFilm -> image = $newFilmData -> image;
        $newFilm -> duration = $newFilmData -> duration;
        $newFilm -> year = $newFilmData -> year;
        $newFilm -> plot = $newFilmData -> plot;
        $newFilm -> rating = $newFilmData -> rating;

        $newFilm->save();
        return $newFilm;
    }
}
