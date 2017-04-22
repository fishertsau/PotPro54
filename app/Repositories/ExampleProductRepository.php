<?php


namespace App\Repositories;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Example\ExampleProduct;
use App\Http\Controllers\PhotoController;

class ExampleProductRepository extends Controller
{
    public static function store(Request $request, $example)
    {
        $oldExampleProductCollection =
            ExampleProduct::where('example_id', $example->id)->lists('id');

        //get input info for this model
        $proIds = $request->get('productId');
        $proTitles = $request->get('proTitle');
        $proPrices = $request->get('proPrice');
        $proBodies = $request->get('proBody');

        $i = 0;
        $newExampleProductList = [];

        foreach ($proIds as $proId) {
            $entryInfo = [
                'title' => $proTitles[$i],
                'price' => $proPrices[$i],
                'body' => $proBodies[$i],
                'rank' => $i,
                'example_id' => $example->id
            ];

            $currentEntryId = static::updateOrNew($proId, $entryInfo, $example);
            $newExampleProductList[] = $currentEntryId;
            $i++;
        }

        static::synExampleProduct($newExampleProductList, $oldExampleProductCollection);
    }

    protected static function entryExists($entryId)
    {
        return !$entryId == 0;
    }

    /**
     * Sync up the Product introduction list
     * the old and obselete items have to be deleted in the DB
     * the newList, derived from the old list, and old list is compared
     * @param $newExampleProductList
     * @param $oldExampleProductCollection
     * @param PhotoController $photoController
     * @return bool
     */
    private static function synExampleProduct($newExampleProductList, $oldExampleProductCollection)
    {

        $photoController = new PhotoController;

        $newExampleProductCollection = collect($newExampleProductList);

        $diff = $oldExampleProductCollection->diff($newExampleProductCollection);

        $diff->each(function ($item, $key) use ($photoController) {
            $exampleProduct = ExampleProduct::findOrFail($item);
            $photoController->deleteCoverPhoto('example_products', $exampleProduct->id);
            $exampleProduct->delete();
        });

        return true;
    }


    protected static function updateOrNew($id, $entryInfo)
    {
        if (!static::entryExists($id)) {
            $newEntryId =
                DB::table('example_products')->insertGetId(
                    $entryInfo
                );
            return $newEntryId;
        }

        ExampleProduct::findOrFail($id)->update($entryInfo);
        return $id;
    }
}