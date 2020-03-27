<?php

use Illuminate\Database\Seeder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Traits\Users\AttachRoleTrait;

class UserSeeder extends Seeder
{
    use AttachRoleTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # make new user root
        $data = [
            'email' => 'root@admin.com',
            'password' => '12345678',
            'name' => 'Root',
            'phone' => '08123456789',
            'type' => 'user',
            'created_by' => 'Root',
            'updated_by' => 'Root'
        ];

        #create new user and activated
        $user = Sentinel::registerAndActivate($data);

        $this->attach($user, 'Root');

    }
}
