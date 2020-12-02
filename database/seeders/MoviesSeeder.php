<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('movies')->delete();
        \DB::table('movies')->insert([
            'title' => 'Titanic',
            'genre' => '2',
            'released_date' => '1997-12-19',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        \DB::table('movies')->insert([
            'title' => 'Grease',
            'genre' => '3',
            'released_date' => '1978-06-16',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        \DB::table('movies')->insert([
            'title' => 'Black Panther',
            'genre' => '4',
            'released_date' => '2018-02-16',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        \DB::table('movies')->insert([
            'title' => 'Bridesmaids ',
            'genre' => '1',
            'released_date' => '2011-04-28',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        \DB::table('movies')->insert([
            'title' => 'Jaws',
            'genre' => '5',
            'released_date' => '1975-06-20',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
