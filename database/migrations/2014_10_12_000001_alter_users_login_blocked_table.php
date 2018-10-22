<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersLoginBlockedTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('login')
                ->after('id')
                ->unique();

            $table->string('name')
                ->nullable()
                ->change();

            $table->string('email')
                ->nullable()
                ->change();

            $table->integer('image_id')
                ->unsigned()
                ->nullable()
                ->after('password');

            $table->boolean('enabled')
                ->default(1)
                ->after('image_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['login', 'enabled', 'image_id']);

            $table->string('email')
                ->nullable(false)
                ->change();

            $table->string('name')
                ->nullable(false)
                ->change();
        });
    }

}
