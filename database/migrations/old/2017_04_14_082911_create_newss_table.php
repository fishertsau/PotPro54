<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newss', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();

            $table->string('slug')->nullable();

            $table->integer('views')->default(0);

            $table->string('title');
            $table->text('body');
            $table->string('coverPhoto_path');

            $table->char('location',1);
            $table->boolean('active');
            $table->boolean('hot');

            $table->boolean('effective_forever');
            $table->date('effective_from');
            $table->date('effective_until');

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('newss');
    }
}
