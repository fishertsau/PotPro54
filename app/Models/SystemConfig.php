<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemConfig extends Model {

	protected $table = 'system_config';

	protected $fillable = [

		//公司基本資料
		'com_name',
		'com_tel',
		'com_fax',
		'com_address',

		//系統參數
		'sys_contact', //系統聯絡人
		'sys_contact_email',
		'sys_contact_tel',
		'number_per_page', //每頁顯示筆數

		//行銷資料
		'seo', //關鍵字
		'site_contact_email', //網站聯絡人 Email
		'site_contact_email_backup1', //網站聯絡人 Email
		'site_contact_email_backup2', //網站聯絡人 Email
		'blog_link', //部落格連結
		'fb_link', //粉絲頁連結
		'gPlus_link', //G+連結

		//公司Logo
		'logo_filename', //公司Logo
		'page_titleIcon_filename', //頁籤icon
		'icon_filename' //內頁icon
	];
}
