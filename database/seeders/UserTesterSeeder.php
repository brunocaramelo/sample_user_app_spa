<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userSeed = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
        ]);

        $personSeed = $userSeed->person()->create([
            'name' => 'Admin',
            'lastname' => 'Tester',
            'cep' => '0232310',
            'street' => 'Rua Falsa',
            'city' => 'Cidade Falsa',
            'street_number' => '8282',
            'state' => 'Estado Falso',
            'neighborhood' => 'Bairro falso',
        ]);

        $userSeed->person_id = $personSeed->id;

        $userSeed->save();
    }
}
