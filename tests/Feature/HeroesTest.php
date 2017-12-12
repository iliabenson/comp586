<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HeroesTest extends TestCase
{
    public function testGetHeroes()
    {
	    $response = $this->call('GET', '/api/heroes');

	    $this->assertEquals(200, $response->status());
    }

    public function testPutHero()
    {
    	$response = $this->call('POST', '/api/heroes', ['name' => 'Punisher']);

    	$response
    		->assertStatus(200)
    		->assertJson([
    			'name' => 'Punisher',
    		]);
    }

    public function testGetHeroByID()
    {
	    $response = $this->call('GET', '/api/heroes/11');

	    $response
	    	->assertStatus(200)
	    	->assertJson([
	    		'id' => 11,
	    		'name' => 'Punisher',
	    	]);
    }

    public function testDeleteHero()
    {
    	$response = $this->call('DELETE', '/api/heroes/11');

    	$response->assertStatus(200);
    }
}
