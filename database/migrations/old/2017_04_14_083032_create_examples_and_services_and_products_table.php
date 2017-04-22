<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamplesAndServicesAndProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examples', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manager_id')->nullable();
            $table->integer('editor_id')->nullable();

            $table->string('slug')->nullable();

            //�W�U�[�P��������
            $table->boolean('activated')->default(false);
            $table->boolean('published')->default(false);
            $table->boolean('hot')->default(false);

           //רҰ򥻸��
            $table->string('title')->default('');
            $table->text('body')->nullable();
            $table->string('coverPhoto_path')->default('');
            $table->string('address')->default('');
            $table->string('tel')->default('');
            $table->string('main_product')->default('');

            $table->string('use_gear');

            //�U���s��
            $table->string('fb_url')->default('');
            $table->string('web_url')->default('');
            $table->string('gplus_url')->default('');

            //�ϥΪ��p
            $table->text('use_result');
            //�{���Ϥ�  �s�b photos
            //�ϥγ]��  �s�b case_product

            //���~����
            //  �x�s�b case_products

            //�A�ȶ���
            //  �x�s�b case_services

            $table->timestamps();

        });
        Schema::create('example_products', function (Blueprint $table) {
            $table->bigIncrements('id');

            //�򥻤��e
            $table->string('title')->default('');
            $table->string('body')->default('');
            $table->integer('rank')->default(0);
            $table->string('coverPhoto_path')->default('');
            $table->integer('price')->unsigned()->nullable();

            $table->integer('example_id')->unsigned();

            $table->foreign('example_id')
                ->references('id')
                ->on('examples')
                ->onDelete('cascade');

            $table->timestamps();
        });
        Schema::create('example_services', function (Blueprint $table) {
            $table->increments('id');

            //�򥻤��e
            $table->string('title')->default('');
            $table->text('body')->nullable();
            $table->integer('rank')->default(0);

            $table->integer('example_id')->unsigned();

            $table->foreign('example_id')
                ->references('id')
                ->on('examples')
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
        Schema::drop('example_services');
        Schema::drop('example_products');
        Schema::drop('examples');
    }
}
