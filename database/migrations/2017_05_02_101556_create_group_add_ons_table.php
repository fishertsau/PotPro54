<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupAddOnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //todo: review if the foreign constraint could just be removed

        Schema::create('group_add_ons', function (Blueprint $table) {
            $table->integer('group_id')->unsigned()->index();
//            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');

            $table->integer('add_on_id')->unsigned()->index();
//            $table->foreign('add_on_id')->references('id')->on('add_ons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('group_add_ons');
    }
}
