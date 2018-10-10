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

            $table->boolean('blocked')
                ->default(0);
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
            $table->dropColumn(['login', 'blocked']);

            $table->string('email')
                ->nullable(false)
                ->change();

            $table->string('name')
                ->nullable(false)
                ->change();
        });
    }

}
