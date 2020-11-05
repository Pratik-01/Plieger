<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$admin = Admin::create([
    	    'fname' => 'admin',
    	    'lname' => 'admin',
    	    'status' => 1,
    	    'email' => 'admin@test.com',
    	    'password' => bcrypt('test123'),
    	    'role_id' => 1,
    	]);

    	$admin->save();
    }
}
