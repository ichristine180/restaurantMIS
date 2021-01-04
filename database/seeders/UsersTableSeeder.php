<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->insert([
            'name' => 'Christine Ingabire',
            'username' => 'chris',
            'email' => 'ichristine180@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('pass'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $roles =[
            ['user_id'=>1,'role_id'=>4],
            ['user_id'=>1,'role_id'=>1],
            ['user_id'=>1,'role_id'=>3]
        ];
       DB::table('role_user')->insert($roles);
    }
}
