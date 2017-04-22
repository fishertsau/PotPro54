<?php

use Illuminate\Database\Seeder;

class SystemConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SystemConfig::findOrNew(1)->update([
            'com_name' => '御鼎節能科技(股)有限公司',
            'com_tel' => '04-3507 9900',
            'com_fax' => '04-2336 9277',
            'com_address' =>  '台中市烏日區五光路復光六巷141號',
            'site_contact_email' => 'fishertsau2live@gmail.com']);
    }
}
