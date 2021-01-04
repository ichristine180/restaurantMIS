<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            ['name'=>'Waiter'],
            ['name'=>'Cashier'],
            ['name'=>'Supervisor'],
            ['name'=>'Manager'],
            ['name'=>'Managing Director']
    ];
        DB::table('roles')->insert($role);
    }
}
