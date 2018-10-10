<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWheelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wheels', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->integer('brand_id')
                ->unsigned();

            $table->integer('collection_id')
                ->unsigned()
                ->nullable();

            $table->integer('style_id')
                ->unsigned()
                ->nullable();

            $table->integer('image_id')
                ->unsigned()
                ->nullable();

            // stat (favoriteCount, likeCount, commentCount)

            $table->integer('popular')->default(0);

            $table->boolean('customized')->default(0);
            $table->boolean('activated')->default(1);
            $table->boolean('retired')->default(0);
            $table->timestamps();

            $table->foreign('brand_id')
                ->references('id')->on('brands')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('collection_id')
                ->references('id')->on('collections')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('style_id')
                ->references('id')->on('styles')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('wheels');
    }
}
