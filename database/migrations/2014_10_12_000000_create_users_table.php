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
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->nullable()->default(null);
            $table->string('password');
            $table->string('provider');
            $table->string('provider_id')->unique();
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
            $table->string('uid')->nullable()->default(NULL);
            $table->timestamps();
            $table->string('access_token')->default(NULL)->nullable()->default(NULL);
            $table->integer('end_of_life')->default(NULL)->nullable()->default(NULL);
            $table->string('refresh_token')->default(NULL)->nullable()->default(NULL);
            $table->string('request_token')->default(NULL)->nullable()->default(NULL);
            $table->string('request_token_secret')->default(NULL)->nullable()->default(NULL);
            $table->text('extra_params')->default(NULL)->nullable()->default(NULL);
            $table->string('access_token_secret')->default(NULL)->nullable()->default(NULL);
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
