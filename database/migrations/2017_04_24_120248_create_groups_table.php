<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');

//            $table->text('description');
//            $table->string('coverPhoto_path');
//
//            $table->string('slug')->nullable();
//
//            $table->string('note');
//            $table->char('good_at', 255);//�A�ήƲz
//            $table->smallInteger('rank');
//            $table->boolean('active');
//
//            $table->boolean('add_on_allowed'); //�O�_�i�H�[�u
//
//            $table->string('auxiliary');
//
//            $table->integer('group_sub_category_id')->unsigned();
//            $table->foreign('group_sub_category_id')
//                ->references('id')
//                ->on('group_sub_categories')
//                ->onDelete('cascade');

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
        Schema::drop('groups');
    }
}
