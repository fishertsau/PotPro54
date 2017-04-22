<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('status')->default('open'); //closed, pending, open

            $table->unsignedInteger('creator_id');
            $table->unsignedInteger('done_recorder_id')->nullable();

            $table->string('title');
            $table->string('content')->nullable();
            $table->string('doer');
            $table->date('expected_finish_at')->nullable();

            $table->date('finished_at')->nullable();

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
        Schema::drop('todos', function (Blueprint $table) {
            //
        });
    }
}
