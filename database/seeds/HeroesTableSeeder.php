<?php

use Illuminate\Database\Seeder;

class HeroesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user_id = App\User::findOrFail(1)->id;
        // factory(App\Hero::class, 10)->create();
		App\Hero::create([
			'user_id' => $user_id,
			'name' => 'Windforce'
		]);
		App\Hero::create([
			'user_id' => $user_id,
			'name' => 'Narco'
		]);
		App\Hero::create([
			'user_id' => $user_id,
			'name' => 'Bombasto'
		]);
		App\Hero::create([
			'user_id' => $user_id,
			'name' => 'Celeritas'
		]);
		App\Hero::create([
			'user_id' => $user_id,
			'name' => 'Magneta'
		]);
		App\Hero::create([
			'user_id' => $user_id,
			'name' => 'RubberMan'
		]);
		App\Hero::create([
			'user_id' => $user_id,
			'name' => 'Dynama'
		]);
		App\Hero::create([
			'user_id' => $user_id,
			'name' => 'Dr IQ'
		]);
		App\Hero::create([
			'user_id' => $user_id,
			'name' => 'Magma'
		]);
		App\Hero::create([
			'user_id' => $user_id,
			'name' => 'Tornado'
		]);
    }
}
