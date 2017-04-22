<?php

namespace App\Http\Controllers\Admin\Product;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\AddOnSelectedOption;

class AddOnSelectedOptionController extends Controller
{
    /**
     * persist the service items
     *
     * @param Request $request
     * @param $add_on
     * @return bool
     */
    public function store(Request $request, $add_on)
    {
        //get the old id list in add on selected options
        $oldAddOnSelectedOptionCollection =
            AddOnSelectedOption::where('add_on_id', $add_on->id)->lists('id');

        //get the input data
        $addOnSelectedOptionIds = $request->get('add_on_selected_option_id');
        $optionNos = $request->get('no');
        $optionIds = $request->get('add_on_option_id');
        $optionables = $request->get('optionable');
        $optionNotes = $request->get('note');

        $i = 0;
        $newAddOnSelectedOptionList = [];

        foreach ($addOnSelectedOptionIds as $selectedOptionId) {
            $entryInfo = [
                'no' => $optionNos[$i],
                'add_on_id' => $add_on->id,
                'rank' => $i,
                'add_on_option_id' => $optionIds[$i],
                'optionable' => $optionables[$i],
                'note' => $optionNotes[$i]
            ];

            $currentEntryId = $this->updateOrNewSelectedOption($selectedOptionId,$entryInfo);
            $newAddOnSelectedOptionList[] = $currentEntryId;
            $i++;
        }

        $this->synAddOnSelectedOption($newAddOnSelectedOptionList, $oldAddOnSelectedOptionCollection);

        return true;
    }

    protected function updateOrNewSelectedOption($id, $entryInfo)
    {
        if (!$this->entryExists($id)) {
            $newEntryId =
                DB::table('add_on_selected_options')->insertGetId(
                    $entryInfo
                );
            return $newEntryId;
        }
        AddOnSelectedOption::findOrFail($id)->update($entryInfo);
        return $id;
    }



    protected function entryExists($entryId)
    {
        return !(($entryId == 0) or ($entryId==''));
    }



    private function synAddOnSelectedOption($newAddOnSelectedOptionList, $oldAddOnSelectedOptionCollection)
    {
        $newAddOnSelectedOptionList = collect($newAddOnSelectedOptionList);

        $diff = $oldAddOnSelectedOptionCollection->diff($newAddOnSelectedOptionList);

        $diff->each(function ($item, $key) {
            $addOnSelectedOption= AddOnSelectedOption::findOrFail($item);
            $addOnSelectedOption->delete();
        });
        return true;
    }
}
