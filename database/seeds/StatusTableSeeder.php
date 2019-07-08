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
        $waiting_status->name_status = 'Submitted';
        $waiting_status->save();

        $approval_status = new Status();
        $approval_status->name_status = 'Approved';
        $approval_status->save();
       
        $approval_status = new Status();
        $approval_status->name_status = 'Rejected';
        $approval_status->save();

        $approval_status = new Status();
        $approval_status->name_status = 'Canceled';
        $approval_status->save();
    }
}
