<?php

use Illuminate\Database\Seeder;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // generating some dummy data
        \App\User::create(['uuid' => '8cc2cace-11b2-457d-a944-af57a7e923de', 'name' => 'Rafiq']);
        \App\User::create(['uuid' => '57cb28b3-a9e8-491d-9fd4-fcc2323b4695', 'name' => 'Thai Li']);
        \App\User::create(['uuid' => '7fa45729-bb97-4c9c-a2a4-af8a343b05d0', 'name' => 'Ashraf']);
    }
}
