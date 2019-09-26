<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\User();
        $admin->name = 'Admin';
        $admin->surname = 'Adminyan';
        $admin->email = 'admin@gmail.com';
        $admin->password = Hash::make(123123);
        $admin->score = 0;
        $admin->role = 1;
        $admin->save();
    }
}
