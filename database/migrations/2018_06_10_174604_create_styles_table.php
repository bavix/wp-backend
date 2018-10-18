<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('styles', function (Blueprint $table) {
            $table->increments('id');

            $table->enum('type', ['I', 'X', 'Y', 'V', 'O']);
            $table->enum('tuple', ['Single', 'Double', 'Triple']);
            $table->integer('spoke');

            $table->boolean('rotated')->default(0);
            $table->boolean('enabled')->default(1);
            $table->timestamps();

            $table->unique([
                'type',
                'tuple',
                'spoke',
                'rotated'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('styles');
    }
}
