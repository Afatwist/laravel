<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
			$table->increments('id');

			$table->string('email')->unique();
			$table->integer('email_confirm')->default(0);
			$table->string('password');
			$table->string('name')->unique();

			$table->string('avatar')->nullable();
			$table->text('about')->nullable();

			$table->integer('roles')->nullable();
			$table->integer('status')->nullable();
			$table->integer('activity')->nullable();

			$table->string('work_place')->nullable();
			$table->string('address')->nullable();
			$table->string('phone')->nullable();

			$table->string('vk')->nullable();
			$table->string('telegram')->nullable();
			$table->string('instagram')->nullable();

			$table->rememberToken();
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
