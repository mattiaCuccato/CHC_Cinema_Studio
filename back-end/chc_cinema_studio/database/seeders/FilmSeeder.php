<?php

namespace Database\Seeders;

use App\Models\Film;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\String_;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('films')->insert([
            'title' => "Iron Man 2",
            'poster' => "img",
            'image' => "img",
            "duration" => 125,
            "year" => 2009,
            "plot" => "bla bla bla bla",
            "rating" => "0+"
        ]);
    }
}
