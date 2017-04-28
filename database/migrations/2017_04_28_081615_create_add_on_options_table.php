<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddOnOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_on_options', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
//            $table->text('body');
//            $table->string('setting_choices');
//            $table->boolean('quantity_change_allowed');

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
        Schema::drop('add_on_options');
    }
}
