<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
	 public function testIndex() 
	 {
		$response = $this->get('/');

		$response->assertStatus(200);
	 }

	public function testAbout()
	{
		$response = $this->get('/about');

		$response->assertStatus(200);
	}
	public function testHome()
	{
		$response = $this->get('/home');

		$response->assertStatus(200);
	}
	public function testContacts()
	{
		$response = $this->get('/contacts');

		$response->assertStatus(200);
	}

}
