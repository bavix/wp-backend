<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('image_id')->unsigned()->nullable();
            $table->string('name')->unique();

            // is_carbon
            // is_multiple
            // is_off_road

            $table->boolean('enabled')->default(1);
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')->on('brands')
                ->onDelete('cascade');

            $table->foreign('image_id')
                ->references('id')->on('images')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
