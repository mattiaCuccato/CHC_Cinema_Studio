<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            'name' => "Rossa",
            'rows' => 10,
            'cols' => 10,
            "max_seats" => 100
        ]);

        DB::table('rooms')->insert([
            'name' => "Gialla",
            'rows' => 10,
            'cols' => 10,
            "max_seats" => 100
        ]);

        DB::table('rooms')->insert([
            'name' => "Verde",
            'rows' => 5,
            'cols' => 7,
            "max_seats" => 35
        ]);
    }
}
