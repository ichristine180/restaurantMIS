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
            [
            'name' => 'Christine Ingabire',
            'username' => 'chris',
            'email' => 'ichristine180@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('pass'),
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'Incungu yanick',
            'username' => 'yanick',
            'email' => 'yanick@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('pass'),
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'Nikole Irakoze',
            'username' => 'nikole',
            'email' => 'nicky@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('pass'),
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'christie Wacu',
            'username' => 'titi',
            'email' => 'titi@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('pass'),
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'Dany wanjye',
            'username' => 'dany',
            'email' => 'dany@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('pass'),
            'created_at' => now(),
            'updated_at' => now()
        ],
        ]);
        $roles =[
            //managing director who can be all but not cashier
            ['user_id'=>1,'role_id'=>1],
            ['user_id'=>1,'role_id'=>3],
            ['user_id'=>1,'role_id'=>4],
            ['user_id'=>1,'role_id'=>5],
              //waiter
            ['user_id'=>2,'role_id'=>1],
            //cashier
            ['user_id'=>3,'role_id'=>2],
            //supervisor who can be a waiter
            ['user_id'=>4,'role_id'=>3],
            ['user_id'=>4,'role_id'=>1],
            //manager who can be a waiter and supervisor
            ['user_id'=>5,'role_id'=>4],
            ['user_id'=>5,'role_id'=>1],
            ['user_id'=>4,'role_id'=>3]
        ];
       DB::table('role_user')->insert($roles);
    }
}
