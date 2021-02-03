<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker; 
use DB;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('App\Models\Category');
        $products = DB::table('category')->insert([
            'name'=>'CHICKEN',
            'image'=>$faker->image('public/storage/images',640,480, null, false),
        ]);
    }
}
