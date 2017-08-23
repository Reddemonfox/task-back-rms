<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\Models\User::create([
            "name"=>"himanshu",
           "email"=>"him@gmail.com",
           "password"=>bcrypt("asdf@1234"),
           "employee_id"=>"EMP-1",
           "type"=>"ADMIN"
       ]);
    }
}
