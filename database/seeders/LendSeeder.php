<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('lending')->delete();
        \DB::table('lending')->insert([
            'movie_id' => '3',
            'member_id' => '1',
            'lending_date' => '2020-11-30',
            'lateness_charge' => '0',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        \DB::table('lending')->insert([
            'movie_id' => '1',
            'member_id' => '2',
            'lending_date' => '2020-05-12',
            'lateness_charge' => '25',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
