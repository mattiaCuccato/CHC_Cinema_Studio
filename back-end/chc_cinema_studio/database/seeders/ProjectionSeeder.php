<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projections')->insert([
            'date' => "2021-11-11 08:54:30",
            'film_id' => 6,
            'room_id' => 2
        ]);

        DB::table('projections')->insert([
            'date' => "2021-11-11 10:54:30",
            'film_id' => 6,
            'room_id' => 2
        ]);

        DB::table('projections')->insert([
            'date' => "2021-11-11 12:54:30",
            'film_id' => 6,
            'room_id' => 3
        ]);

        DB::table('projections')->insert([
            'date' => "2021-11-12 08:54:30",
            'film_id' => 6,
            'room_id' => 1
        ]);
    }
}
