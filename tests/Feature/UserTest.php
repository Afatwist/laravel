<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserTest extends TestCase
{
	use RefreshDatabase;
	
	/**
	 * @test
	 */
	public function UserList()
	{
		$user = factory(User::class)->create();
		$response = $this->get('/userlist');

		$response->assertSee($user->id);
		$response->assertStatus(200);		
	}
	/**
	 * @test
	 */
	public function Paginator()
	{
		$user = factory(User::class)->create();
		$response = $this->get('/paginator');

		$response->assertSee($user->name);
		$response->assertStatus(200);
	}

	/**
	 * @test
	 */
	public function Profile()
	{
		$user = factory(User::class)->create();
		$response = $this->get('/profile/id='.$user->id);

		$response->assertSee($user->name);
		$response->assertStatus(200);
	}
}
