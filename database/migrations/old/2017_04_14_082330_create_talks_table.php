<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTalksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();

            $table->string('title');
            $table->text('body');
            $table->string('coverPhoto_path')->nullable();

            $table->date('held_on')->nullable();
            $table->string('location')->default('');
            $table->integer('speaker_id')->nullable();

            $table->text('organizer')->nullable();  //�D����
            $table->string('organizer_url')->default('');
            $table->text('execute_org')->nullable();  //������
            $table->string('execute_org_url')->default('');
            $table->text('assist_org')->nullable();  //�����
            $table->string('assist_org_url')->default('');

            $table->timestamps();

            $table->boolean('active')->default(false);

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
        Schema::drop('talks');
    }
}
