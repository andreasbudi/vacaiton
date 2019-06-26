<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_staff = new Role();
        $role_staff->name_role = 'Staff';
        $role_staff->save();

        $role_spv = new Role();
        $role_spv->name_role = 'Spv';
        $role_spv->save();

        $role_manager = new Role();
        $role_manager->name_role = 'Manager';
        $role_manager->save();

        $role_admin = new Role();
        $role_admin->name_role = 'Admin';
        $role_admin->save();
    }
}
