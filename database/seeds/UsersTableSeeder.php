<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'admin',
            'birth_date' => '19960101',
            'contact_number' => '00000000000',
            'employee_id' => '000',
            'company_name' => '1',
            'register' => '1',
            'role' => '1',
            'activate' => '1',
            'email' => 'renzchristian.cabato@lafilgroup.com',
            'password' => bcrypt('P@ssw0rd'),
        ]);
    }
}
