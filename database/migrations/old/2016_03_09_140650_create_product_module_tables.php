<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductModuleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->text('body');

            $table->string('tag_no');
            $table->boolean('active');

            $table->smallInteger('rank');

            $table->timestamps();
        });

        Schema::create('group_sub_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->text('body');

            $table->string('tag_no');
            $table->boolean('active');

            $table->smallInteger('rank');

            $table->integer('group_category_id')->unsigned();
            $table->foreign('group_category_id')
                ->references('id')
                ->on('group_categories')
                ->onDelete('cascade');


            $table->timestamps();
        });


        Schema::create('add_ons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body');
            $table->string('coverPhoto_path');
            $table->boolean('quantity_change_allowed');

            $table->timestamps();
        });

        Schema::create('group_add_ons', function (Blueprint $table) {
            $table->integer('group_id')->unsigned()->index();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');

            $table->integer('add_on_id')->unsigned()->index();
            $table->foreign('add_on_id')->references('id')->on('add_ons')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('add_on_options', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->text('body');
            $table->string('setting_choices');
            $table->boolean('quantity_change_allowed');

            $table->timestamps();
        });

        Schema::create('add_on_selected_options', function (Blueprint $table) {
            $table->increments('id');

            //�򥻤��e
            $table->string('no');
            $table->integer('rank');
            $table->boolean('optionable');
            $table->integer('add_on_id')->unsigned();
            $table->integer('add_on_option_id')->unsigned();
            $table->char('note', 20)->nullable();

            $table->foreign('add_on_id')
                ->references('id')
                ->on('add_ons')
                ->onDelete('cascade');

            $table->foreign('add_on_option_id')
                ->references('id')
                ->on('add_on_options')
                ->onDelete('cascade');

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
        Schema::drop('add_on_selected_options');
        Schema::drop('add_on_options');
        Schema::drop('group_add_ons');
        Schema::drop('add_ons');
        Schema::drop('group_sub_categories');
        Schema::drop('group_categories');
    }
}
