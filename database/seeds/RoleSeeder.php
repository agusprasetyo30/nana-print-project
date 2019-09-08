<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "[+] Add Role Successfully \n";

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'customer']);
    }
}
