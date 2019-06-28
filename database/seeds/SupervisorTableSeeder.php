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
        $spv->save();

        $spv = new Supervisor();
        $spv->name_supervisor = 'Alex';
        $spv->save();

        $spv = new Supervisor();
        $spv->name_supervisor = 'Margaret';
        $spv->save();
    }
}
