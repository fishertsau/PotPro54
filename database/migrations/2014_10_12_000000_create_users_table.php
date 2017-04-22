<?php

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
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
//            $table->softDeletes();
            $table->timestamps();

//            $table->string('avatar')->nullable();
            $table->integer('signIn_count')->default(0);
//            $table->char('login_ip',19);
//
//            $table->char('tel',15)->nullable();
//            $table->boolean('active')->default(true);
//            $table->string('verified_token');
//            $table->boolean('verified')->default(false);
//            $table->char('zip',5)->nullable();
//            $table->string('address')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
