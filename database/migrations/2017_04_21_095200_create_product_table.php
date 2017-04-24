<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('price');
            $table->text('description');
            $table->boolean('published')->default(false);

//            $table->string('model');//����
//            $table->char('pn', 12);//���~�s��
//
//            $table->string('slug')->nullable();
//
//            $table->string('coverPhoto_path');
//
//            $table->smallInteger('length');//����
//            $table->smallInteger('width');//�e��
//            $table->smallInteger('height');//����
//            $table->smallInteger('diameter');//���|
//            $table->smallInteger('depth');//�`��
//            $table->smallInteger('capacity');//�e�q����
//
//
//            $table->string('note');
//
//
//            $table->string('type');//�׺��� �Ӱv�� �L����
//            $table->integer('group_id')->unsigned();
//            $table->foreign('group_id')
//                ->references('id')
//                ->on('groups')
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
        Schema::drop('products');
    }
}
