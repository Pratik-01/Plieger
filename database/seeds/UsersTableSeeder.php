<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	    $user = User::create([
	        'fname' => 'admin',
	        'lname' => 'admin',
	        'status' => 1,
	        'email' => 'admin@test.com',
	        'password' => bcrypt('test123'),
	        'role_id' => 1,
	    ]);

	    $user->save();
    }
}
