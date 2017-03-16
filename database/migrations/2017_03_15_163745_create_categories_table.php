<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable()->default(null);
            $table->integer('parent_id')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('user_likes', function ($table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('fave_id')->nullable()->default(null);
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
        Schema::dropIfExists('categories');
        Schema::dropIfExists('user_likes');
    }
}
