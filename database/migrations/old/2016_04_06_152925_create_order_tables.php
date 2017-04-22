<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->index();

            $table->char('po_no', 12)->index(); //�q�渹�X  yyyymmdd-xxx (xxx is hexadecimal)
            $table->integer('amount'); //�q����B
            $table->smallInteger('qty'); //�~���ƶq
            $table->string('note'); //�q�满��


            //�q�檬�A: (1)�q�檬�A  (2)�B�z���q (3)�B�z���q���A
            $table->char('status_flag', 1);  //��i�q�檬�A: (1)normal (2)finished (3)rejected (4)cancelled (5)on-hold
            $table->char('phase', 1);   // �q���ƻ򶥬q: (1)start, (2)auditing, (3)production, (4)stocking, (5)shipping, (6)finished
            $table->char('phase_status_flag', 1); //�b���q�� �����A (1)TBP, (2)processing, (3)finished, (4)on-hold, (5)cancelled


            $table->integer('buyer_id')->unsigned(); //�ʶR�H
            $table->integer('entry_user_id')->unsigned(); //�U��H

            $table->foreign('buyer_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->timestamps();
        });


        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('order_id')->unsigned();

            $table->char('group_id');
            $table->char('product_id');
            $table->char('type', 10);
            $table->smallInteger('qty')->unsigned();
            $table->smallInteger('price')->unsigned();
            $table->integer('subtotal')->unsigned();
            $table->string('options');
            $table->string('note');

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');

            $table->timestamps();
        });


        Schema::create('order_shipments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('recorder_id')->unsigned();
            $table->char('shipper', 20);
            $table->char('tracking_no', 20);
            $table->date('shipped_at');
            $table->string('note');
            $table->char('sales_slip_no', 15)->nullable();

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
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
        Schema::drop('order_shipments');
        Schema::drop('order_items');
        Schema::drop('orders');
    }
}
