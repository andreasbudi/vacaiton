<?php

use Illuminate\Database\Seeder;
use App\Supervisor;

class SupervisorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spv = new Supervisor();
        $spv->name_supervisor = 'Andika';
        // $spv->email = 'andreas.b365@gmail.com';
        $spv->email = 'andika.pranata@difinite.com';
        $spv->save();

        $spv = new Supervisor();
        $spv->name_supervisor = 'Alex';
        // $spv->email = 'andreas.b365@gmail.com';
        $spv->email = 'alexander.arda@difinite.com';
        $spv->save();

        $spv = new Supervisor();
        $spv->name_supervisor = 'Margaret';
        // $spv->email = 'andreas.b365@gmail.com';
        $spv->email = 'margaret.pratiwi@difinite.com';
        $spv->save();
    }
}
