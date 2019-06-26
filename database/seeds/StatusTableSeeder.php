<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $waiting_status = new Status();
        $waiting_status->name_status = 'Waiting For Approval';
        $waiting_status->save();

        $approval_status = new Status();
        $approval_status->name_status = 'Approved by ';
        $approval_status->save();
    }
}
