<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class AdminUserTest extends TestCase
{
	use RefreshDatabase;
	
	/**
	 * @test
	 */
	public function create()
	{
		$response = $this->get('admin/users/create');

		$response->assertStatus(200);
	}

	/**
	 * @test
	 */
	public function createAction()
	{
		$user = factory(User::class)->create();
		$response = $this->get('admin/users/edit/id=' . $user->id);

		$response->assertSee($user->id);
		$response->assertStatus(200);
	}
}
