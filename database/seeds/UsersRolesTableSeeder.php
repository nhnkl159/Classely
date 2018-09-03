<?php

use Illuminate\Database\Seeder;

class UsersRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Root
        DB::table('users_roles')->insert([
            'name' => 'מנהל המערכת'
        ]);

        //Admin -- Principal
        DB::table('users_roles')->insert([
            'name' => 'מנהל בית ספר'
        ]);

        //Teacher
        DB::table('users_roles')->insert([
            'name' => 'מורה'
        ]);

        //Parent
        DB::table('users_roles')->insert([
            'name' => 'הורה'
        ]);

        //Student
        DB::table('users_roles')->insert([
            'name' => 'תלמיד'
        ]);

        //Banned
        DB::table('users_roles')->insert([
            'name' => 'מורחק'
        ]);
    }
}
