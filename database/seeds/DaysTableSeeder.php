<?php

use Illuminate\Database\Seeder;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('days')->insert([
            'name' => 'ראשון'
        ]);
        DB::table('days')->insert([
            'name' => 'שני'
        ]);
        DB::table('days')->insert([
            'name' => 'שלישי'
        ]);
        DB::table('days')->insert([
            'name' => 'רביעי'
        ]);
        DB::table('days')->insert([
            'name' => 'חמישי'
        ]);
        DB::table('days')->insert([
            'name' => 'שישי'
        ]);
    }
}
