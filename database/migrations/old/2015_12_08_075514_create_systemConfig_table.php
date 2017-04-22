<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemConfigTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('system_config', function (Blueprint $table)
		{
			//�û��u��id=1  �@�����
			$table->increments('id');

			//���q�򥻸��
			$table->string('com_name');
			$table->string('com_tel');
			$table->string('com_fax');
			$table->string('com_address');

			//�t���p���H
			$table->string('sys_contact');  				//�t���p���H
			$table->string('sys_contact_email');
            $table->string('site_contact_email_backup1'); //�����p���H Email
            $table->string('site_contact_email_backup2'); //�����p���H Email

            $table->string('sys_contact_tel');
            $table->tinyInteger('number_per_page')->unsigned();  //�C����ܵ���


            //��P���
			$table->string('seo'); //����r
			$table->string('site_contact_email'); //�����p���H Email
			$table->string('blog_link'); //������s��
			$table->string('fb_link'); //�������s��
			$table->string('gPlus_link'); //G+�s��

			//���qLogo
			$table->string('logo_filename'); //���qLogo
			$table->string('page_titleIcon_filename'); //����icon
			$table->string('icon_filename'); //����icon

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
		Schema::drop('system_config');
	}
}
