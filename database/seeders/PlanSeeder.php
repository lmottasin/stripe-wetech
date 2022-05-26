<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
            'pricing_api_id' => 'price_1L2AX6C6zJ5fy5JUgRmE6mT0',
            'description'=>'Basic Plan-Upto 10 post, 50 post read per day',
            'plan_name'=>'Basic',
            'price'=> 10.00

        ]);
        DB::table('plans')->insert([
            'pricing_api_id' => 'price_1L2AX6C6zJ5fy5JU22YZJYRS',
            'description'=>'Plus plan-Upto 10 post, 50 post read per day',
            'plan_name'=>'Plus',
            'price'=> 20.00
        ]);
        DB::table('plans')->insert([
            'pricing_api_id' => 'price_1L3ZgUC6zJ5fy5JU9iULpavF',
            'description'=>'Pro plan-Upto 10 post, 50 post read per day',
            'plan_name'=>'Pro',
            'price'=> 30.00
        ]);
    }
}
