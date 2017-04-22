<?php

namespace App\Http\Controllers;

use App\Models\SystemConfig;
use App\Http\Requests;

class SystemConfigController extends Controller
{
    /** Get all the site contact list for this company
     * @return array
     */
    public static function emailContactList(){
        $systemConfig = SystemConfig::findOrFail(1);
        return  [
            $systemConfig->site_contact_email,
            $systemConfig->site_contact_email_backup1,
            $systemConfig->site_contact_email_backup2,
        ];
    }
}
