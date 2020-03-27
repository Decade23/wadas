<?php

use Illuminate\Database\Seeder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #create role user
        #user root
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Root',
            'permissions' => ['dashboard' => true],
            'slug' => 'root',
            'created_by' => 'Root',
            'updated_by' => 'Root'
        ]);

        #user sales
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Sales',
            'permissions' => ['dashboard' => true],
            'slug' => 'sales',
            'created_by' => 'Root',
            'updated_by' => 'Root'
        ]);

        #user member
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Member',
            'permissions' => ['dashboard' => true],
            'slug' => 'member',
            'created_by' => 'Root',
            'updated_by' => 'Root'
        ]);
    }
}
