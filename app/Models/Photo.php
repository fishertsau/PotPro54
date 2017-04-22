<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\PhotoController;

class Photo extends Model
{

    protected $fillable = [
        'path'
    ];


    public function imageable()
    {
        return $this->morphTo();
    }


    public function delete()
    {
        $photoController = new PhotoController;

        $storagePath = $photoController->photoStoragePath($this->path);

        \File::delete([
            $storagePath
            ]);

        parent::delete(); //��ۤv�o�� entry/instance delete
    }
}
