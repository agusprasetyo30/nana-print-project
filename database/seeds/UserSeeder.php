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

        $user->name = "Administrator";
        $user->email = "admin@gmail.com";
        $user->username = "admin";
        $user->password = Hash::make('admin');
        $user->alamat = "Ds. Gesikharjo";
        $user->phone = "085731897771";
        $user->status = "ACTIVE";
        $user->avatar = "NO IMAGE";

        $user->save();

        $user->assignRole('admin');
    }
}
