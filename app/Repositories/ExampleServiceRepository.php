<?php

namespace App\Repositories;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Example\ExampleService;
use App\Http\Controllers\Controller;

class ExampleServiceRepository extends Controller
{
    public static function store(Request $request, $example)
    {
        $oldExampleServiceCollection =
            ExampleService::where('example_id', $example->id)->lists('id');

        $serviceIds = $request->get('exampleServiceId');
        $serviceTitles = $request->get('serviceTitle');
        $serviceContent = $request->get('serviceContent');

        $i = 0;
        $newExampleServiceList = [];

        foreach ($serviceIds as $serviceId) {
            $entryInfo = [
                'title' => $serviceTitles[$i],
                'body' => $serviceContent[$i],
                'rank' => $i,
                'example_id' => $example->id
            ];

            $currentEntryId = static::updateOrNew($serviceId, $entryInfo, $example);
            $newExampleServiceList[] = $currentEntryId;
            $i++;
        }

        static::synExampleService($newExampleServiceList, $oldExampleServiceCollection);

        return true;
    }


    protected static function updateOrNew($id, $entryInfo)
    {
        if (!static::entryExists($id)) {
            $newEntryId =
                DB::table('example_services')->insertGetId(
                    $entryInfo
                );
            return $newEntryId;
        }

        ExampleService::findOrFail($id)->update($entryInfo);
        return $id;
    }


    protected static function entryExists($entryId)
    {
        return !(($entryId == 0) or ($entryId==''));
    }


    /**
     * Sync up the Product  service list
     * the old and obselete items have to be deleted in the DB
     * the newList, derived from the old list, and old list is compared
     * @param $newExampleServiceList
     * @param $oldExampleProductCollection
     * @return bool
     */
    private static function synExampleService($newExampleServiceList, $oldExampleProductCollection)
    {

        $newExampleProductCollection = collect($newExampleServiceList);

        $diff = $oldExampleProductCollection->diff($newExampleProductCollection);

        $diff->each(function ($item, $key) {
            $exampleService = ExampleService::findOrFail($item);
            $exampleService->delete();
        });

        return true;
    }

}