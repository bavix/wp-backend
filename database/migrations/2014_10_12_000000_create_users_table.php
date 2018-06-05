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
            $table->string('login')->unique();
            $table->string('password');
            $table->boolean('verified')->default(0);
            $table->boolean('activated')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['email', 'phone']);
            $table->string('value');
            $table->boolean('confirmed')->default(0);
            $table->integer('user_id');
            $table->unique(['type', 'value']);
            $table->timestamps();
        });

        Schema::create('user_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('about')->nullable();
            $table->integer('user_id')->unique();
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
        Schema::dropIfExists('roles');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('user_info');
    }
}
