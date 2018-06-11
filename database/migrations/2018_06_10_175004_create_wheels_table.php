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
            $table->integer('brand_id');
            $table->integer('collection_id')->nullable();
            $table->integer('style_id')->nullable();
            $table->integer('image_id')->nullable();
            $table->string('name');

            // stat (favoriteCount, likeCount, commentCount)

            $table->integer('popular')->default(0);

            $table->integer('customized')->default(0);
            $table->integer('retired')->default(0);
            $table->integer('activated')->default(1);
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
        Schema::dropIfExists('wheels');
    }
}
