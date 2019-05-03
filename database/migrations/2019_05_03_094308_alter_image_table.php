<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterImageTable extends Migration
{

    /**
     * @param string $class
     * @param string $bucket
     * @return bool|int
     */
    protected function update(string $class, string $bucket): int
    {
        $subQuery = $class::query()
            ->select('image_id');

        return \App\Models\Image::query()
            ->whereIn('id', $subQuery)
            ->update(['bucket' => $bucket]);
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn([
                'imageable_type',
                'imageable_id',
            ]);
            $table->string('bucket')
                ->nullable()
                ->after('id');
        });

        $this->update(\App\Models\Wheel::class, 'wheels');
        $this->update(\App\Models\Brand::class, 'brands');
        $this->update(\App\Models\User::class, 'users');

        Schema::table('images', function (Blueprint $table) {
            $table->string('bucket')
                ->after('id')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->nullableMorphs('imageable');
            $table->dropColumn('bucket');
        });
    }

}
