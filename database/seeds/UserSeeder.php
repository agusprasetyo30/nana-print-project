<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo"[+] Add Admin & Customer process . . . \n";

        // Admin
        $admin = new User;

        $admin->name = "admin";
        $admin->email = "admin@gmail.com";
        $admin->username = "admin";
        $admin->password = Hash::make('admin');
        $admin->address = "Ds. Palang";
        $admin->phone = "085731897771";
        $admin->status = "INACTIVE";
        $admin->avatar = "NO IMAGE";

        $admin->save();

        $admin->assignRole('admin');

        // Customer
        $customer = new User;

        $customer->name = "Customer";
        $customer->email = "customer@gmail.com";
        $customer->username = "customer";
        $customer->password = Hash::make('customer');
        $customer->address = "Ds. Palang";
        $customer->phone = "085731897771";
        $customer->status = "INACTIVE";
        $customer->avatar = "NO IMAGE";

        $customer->save();

        $customer->assignRole('customer');

    }
}
