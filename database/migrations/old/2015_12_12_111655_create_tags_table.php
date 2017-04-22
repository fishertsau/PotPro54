<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tags', function (Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});

		/*
		 Schema::create('news_tag', function (Blueprint $table) {
			$table->integer('news_id')->unsigned()->index();
			$table->foreign('news_id')->references('id')->on('newss')->onDelete('cascade');

			$table->integer('tag_id')->unsigned()->index();
			$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

			$table->timestamps();
		});
		 * */
		Schema::create('taggables', function (Blueprint $table)
		{
			$table->integer('taggable_id')->unsigned()->index();

			$table->integer('tag_id')->unsigned()->index();
			$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

			$table->string('taggable_type');

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
		//Schema::drop('news_tag');
		Schema::drop('taggables');
		Schema::drop('tags');
	}
}
