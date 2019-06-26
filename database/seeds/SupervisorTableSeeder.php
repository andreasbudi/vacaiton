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
        $spv->name = 'Andika';
        $spv->save();

        $spv = new Supervisor();
        $spv->name = 'Alex';
        $spv->save();

        $spv = new Supervisor();
        $spv->name = 'Margaret';
        $spv->save();
    }
}
