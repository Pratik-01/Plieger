<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$role = Role::create([
    		'title' => 'admin'
    	]);

    	$role->save();

        $role = Role::create([
            'title' => 'client'
        ]);

        $role->save();
    }
}
