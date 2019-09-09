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
        echo"[+] Add User process . . . \n";

        $user = new User;

        $user->name = "Customers1";
        $user->email = "customer1@gmail.com";
        $user->username = "customer1";
        $user->password = Hash::make('customer1');
        $user->address = "Ds. Palang";
        $user->phone = "085731897771";
        $user->status = "INACTIVE";
        $user->avatar = "NO IMAGE";

        $user->save();

        $user->assignRole('customer');
    }
}
