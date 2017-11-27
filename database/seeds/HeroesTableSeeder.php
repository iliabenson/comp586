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
        // factory(App\Hero::class, 10)->create();
		App\Hero::create([
			'name' => 'Windforce'
		]);
		App\Hero::create([
			'name' => 'Narco'
		]);
		App\Hero::create([
			'name' => 'Bombasto'
		]);
		App\Hero::create([
			'name' => 'Celeritas'
		]);
		App\Hero::create([
			'name' => 'Magneta'
		]);
		App\Hero::create([
			'name' => 'RubberMan'
		]);
		App\Hero::create([
			'name' => 'Dynama'
		]);
		App\Hero::create([
			'name' => 'Dr IQ'
		]);
		App\Hero::create([
			'name' => 'Magma'
		]);
		App\Hero::create([
			'name' => 'Tornado'
		]);
    }
}
