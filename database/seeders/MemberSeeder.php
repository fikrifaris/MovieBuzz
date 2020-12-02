<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('members')->delete();
        \DB::table('members')->insert([
            'name' => 'David',
            'age' => '32',
            'address' => 'St.Street 62',
            'telephone' => '652148',
            'identity_number' => '0021156',
            'date_of_joined' => '2010-12-19',
            'is_active' => '1',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        \DB::table('members')->insert([
            'name' => 'Frank',
            'age' => '55',
            'address' => 'Auguste Road',
            'telephone' => '981315',
            'identity_number' => '0026587',
            'date_of_joined' => '2000-01-02',
            'is_active' => '0',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        \DB::table('members')->insert([
            'name' => 'Susy',
            'age' => '19',
            'address' => 'Mont Darc',
            'telephone' => '245307',
            'identity_number' => '0126547',
            'date_of_joined' => '2020-11-19',
            'is_active' => '1',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        \DB::table('members')->insert([
            'name' => 'Rex',
            'age' => '25',
            'address' => 'Bestia Rd',
            'telephone' => '952345',
            'identity_number' => '0235613',
            'date_of_joined' => '2019-05-01',
            'is_active' => '1',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

    }
}
