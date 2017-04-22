<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStatusRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_status_records', function (Blueprint $table) {
            $table->increments('id')->index();

            $table->char('action', 12);
            $table->string('comments')->nullable();

            $table->integer('auditor_id')->unsigned();
            $table->foreign('auditor_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->integer('order_id')->unsigned();

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('restrict');

            $table->dateTimeTz('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_status_records');
    }
}
