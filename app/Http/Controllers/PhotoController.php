<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Photo;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PhotoController extends Controller
{
    /***  Photo Controller *****/
    public function store($model, $id, Request $request)
    {
//        $model = 'App\Models\\' . $model;
        $model = 'App\Models\Example\\' . $model;
        //'App\Models\\' : the directory where models are saved.
        //The function of this method is not clear.  Should be reviewed someday.  2016/7/5

        $entry = $model::findOrFail($id);

        $photo = $this->createPhoto($request->file('photo'));

        $entry->photos()->save($photo);

        return $photo->id;
    }


    public function destroy($id)
    {
        Photo::findOrFail($id)->delete();
        return 'done';
    }


    public function photoStoragePath($filename)
    {
        return public_path() . $this->photoBaseDir() . $filename;
    }


    protected function createPhoto(UploadedFile $file)
    {
        $desFilename = time() . '-' . $file->getClientOriginalName();
        $file->move(public_path() . $this->photoBaseDir(), $desFilename);
        return Photo::create(['path' => $desFilename]);
    }


    /***  coverPhoto Controller **
     * @param $table
     * @param $id
     * @param Request $request
     * @return string
     */
    public
    function saveCoverPhotoAjax($table, $id, Request $request)
    {
        $file = $request->file('coverPhoto_file');

        if (!is_file($file)) {
            return 'no file got';
        }

        $fieldName = $this->normalizeFieldName($request->input('fieldName'));

        $desFilename = $this->makeCoverPhoto($file);

        //Check for ExampleProducts table.
        //If this entry does not exist, create a new and return
        //This is specially designed for ExampleProducts
        //This part should be coded for general cases.
        if (!entryExist($table, $id)) {
            $foreignKey = $request->input('foreignKey');
            $id = DB::table($table)->insertGetId(
                ['example_id' => $foreignKey,
                    $fieldName => $desFilename]
            );
            return [$desFilename, $id];
        }

        $this->clearOldPhotoFile($table, $id, $fieldName);
        $this->persistPath($table, $id, $desFilename, $fieldName);

        return $desFilename;
    }


    protected function clearOldPhotoFile($table, $id, $fieldName)
    {
        $this->deleteCoverPhoto($table, $id, $fieldName);
    }


    /**  Used  by other controller
     * @param UploadedFile $file
     * @param $model
     * @return bool
     */
    static function saveCoverPhoto(UploadedFile $file, $model)
    {
        $fieldName = (new static)->normalizeFieldName();
        if (is_file($file)) {
            $desFilename = static::makeCoverPhoto($file);
            $model->update([$fieldName => $desFilename]);
        }
        return true;
    }

    private function persistPath($table, $id, $destinationFilename, $fieldName)
    {
        DB::table($table)
            ->whereId($id)
            ->update([$fieldName => $destinationFilename]);
    }


    protected function makeCoverPhoto(UploadedFile $file)
    {
        $desFilename = $this->generateFilename($file);
        $this->moveFileToStorage($file, $desFilename);
        return $desFilename;
    }


    protected function generateFilename(UploadedFile $file)
    {
        return time() . $file->getClientOriginalName();
    }


    protected function moveFileToStorage($file, $destinationFilename)
    {
        $file->move(public_path() . $this->coverBaseDir(),
            $destinationFilename);
    }


    public function  deleteCoverPhoto($table, $id, $filedName = '')
    {
        $field = $this->normalizeFieldName($filedName);

        if ($this->hasPhotoPathInfo($table, $id, $field)) {
            $this->flushRecordAndStorage($table, $id, $field);
        }

        return 'done';
    }


    protected function hasPhotoPathInfo($table, $id, $field)
    {
        $entry = DB::table($table)->where('id', $id)->first();
        return $entry->$field != '';
    }

    protected function flushRecordAndStorage($table, $id, $field)
    {
        $entry = DB::table($table)
            ->whereId($id)->first();

        DB::table($table)->
        whereId($id)->
        update([$field => '']);

        \File::delete(
            $this->coverPhotoStoragePath(
                $entry->$field));

        return true;
    }


    public function coverPhotoStoragePath($filename)
    {
        return public_path() . $this->coverBaseDir() . $filename;
    }


    protected function coverBaseDir()
    {
        return '/assets/images/cover/';
    }

    protected function photoBaseDir()
    {
        return '/assets/images/photos/';
    }


    public function deletePhotos(Collection $photos)
    {
        $photos->each(function ($photo) {
            \File::delete($this->photoBaseDir() . $photo->path);
        });

        deleteRecord($photos);
    }


    /** This is to get the correct field name for storage or deletion
     * @param string $fieldName
     * @return string
     */
    protected function normalizeFieldName($fieldName = '')
    {
        return ($fieldName == '') ? 'coverPhoto_path' : $fieldName;
    }
}