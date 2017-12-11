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
        App\User::create([
            'name' => 'ilia',
            'email' => 'ilia.benson.72@my.csun.edu',
            'password' => bcrypt('google'),
            'remember_token' => str_random(10)
        ]);

        App\User::create([
            'name' => 'felix',
            'email' => 'felix.rabinovich@csun.edu',
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10)
        ]);

        // factory(App\User::class, 10)->create();
    }
}
