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
            $table->string('name')->nullable()->default(null);
            $table->string('username')->unique()->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('password')->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();
        });

        /*
      * Create social login table
      */
        Schema::create('social', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id');
            $table->string('service');
            $table->string('uid')->nullable()->default(null);
            $table->timestamps();
            $table->string('access_token')->nullable()->default(null);
            $table->integer('end_of_life')->nullable()->default(null);
            $table->string('refresh_token')->nullable()->default(null);
            $table->string('request_token')->nullable()->default(null);
            $table->string('request_token_secret')->nullable()->default(null);
            $table->text('extra_params')->nullable()->default(null);
            $table->string('access_token_secret')->nullable()->default(null);
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
        Schema::dropIfExists('social');
    }
}
