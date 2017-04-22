<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\SystemConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class System_configsController extends Controller
{
    /**
     * System_configsController constructor.
     */
    public function __construct()
    {
//        if (Auth::user()->cannot('system-config')) {
//            flash()->overlay('您沒有修改系統設定的權限!');
//            return redirect('admin');
//        }
    }

    public function editSystemConfig()
    {
        $system_config = SystemConfig::firstOrNew(['id' => '1']);
        return view('admin.system_configs.edit', compact('system_config'));
    }

    public function update(Request $request)
    {
        $this->moveUploadedLogo('logo_filename', 'brandLogo.png', $request);
        $this->moveUploadedLogo('page_titleIcon_filename', 'iconLogo-2.png', $request);
        $this->moveUploadedLogo('icon_filename', 'iconLogo.png', $request);

        $entry = SystemConfig::firstOrCreate(['id' => '1']);
        $entry->update($request->all());

		flash()->overlay('您剛剛修改了系統設定!');

        return redirect('/admin');
    }

    private function moveUploadedLogo($clientFile, $desFilename, Request $request)
    {
        if ($request->hasFile($clientFile)) {
            $file = $request->file($clientFile);
            $file->move(public_path() . '/assets/images/companyInfo', $desFilename);
        }
    }
}