<?php

namespace App\Http\Controllers\FrontEnd\Cart;

use Acme\Facade\Cart;
use App\Http\Controllers\Controller;


class AddOnController extends Controller
{
    public function store()
    {
        $setId = request('set_id');
        $addOns = collect(request('add_on'));

        $qty = collect(Cart::items()->where('set_id', $setId)->all())
            ->first(function ($item) {
                return isset($item['product_id']);
            })['qty'];

        $addOns->each(function ($addonInput) use ($setId, $qty) {
            $addon = [
                'set_id' => $setId,
                'addOn_id' => $addonInput['addOn_id'],
                'qty' => $qty,
                'setting' => $addonInput['setting'],
            ];

            Cart::addAddon($addon);
        });
    }
}







//    private $add_on_setting_input_fields = [
//        'id' => 'settingOptionId-for-addOnId',
//        'no' => 'settingNo-for-addOnId',
//        'chosenNo' => 'settingNoChosen-for-addOnId',
//        'title' => 'settingTitle-for-addOnId',
//        'setting' => 'setting-for-addOnId',
//        'note' => 'settingNote-for-addOnId'
//    ];

/**
 * Format for option setting string
 * [no] title:'setting' setting_unit (note)
 *  note的括號,需要在serialization時 自己加入
 *   * @var string
 */
//    private $optionSettingFormat = "[%s]%s:'%s'%s%s,";

/**
 * The two variables are just for use in each setting record, and only use inside the class
 * The two variables are not meant to be used outside the class
 * 有點類似暫存器
 * @var
 */
//    private $settingInput;
//    private $optionSettingString;
//    private $optionPrice;


/**
 *  Store which group, product, what add on we are working on in this controller
 * @var
 */

/**
 *  Group in the card
 * */
//    private $product;

/**
 * AddOnController constructor.
 */
//    public function __construct()
//    {
//        $this->middleware('activatedSales');
//    }


//    public function edit(Request $request)
//    {
//        //所屬購物車群組號碼
//        $group_id = $request->input('group_id');
//
//        //所屬購物車品項
//        $productRowId = Cart::search(['groupid' => $group_id, 'type' => 'product']); //belongs to which group
//        $productRow = Cart::get($productRowId[0]);                                  //belongs to which product
//
//        //所屬產品
//        $product = Product::find($productRow->id);  //get the product instance, so that we know what add on are required
//
//        //數量
//        $add_on_unit_qty =
//            $this->getOldAddOnUnitQty($group_id);
//
//        //舊有設定
//        $add_on_setting =
//            $this->getOriginalAddOnOptionSetting($group_id);
//
//        return view('frontEnd.order.addOn.addOnEdit',
//            compact('product', 'add_on_setting', 'group_id', 'add_on_unit_qty'));
//    }


//    protected function getOldAddOnUnitQty($group_id = null)
//    {
//        $addOnRowIds = Cart::search(['groupid' => $group_id, 'type' => 'add_on']);
//
//        //如果沒有 就傳回空的資料
//        if (!$this->hasAddOn($addOnRowIds)) {
//            return [];
//        }
//
//        $add_on_unit_qty = [];
//        foreach ($addOnRowIds as $rowId) {
//            $row = Cart::get($rowId);
//            $add_on_unit_qty[$row->id] = $row->options->unit_qty;
//        }
//
//        return $add_on_unit_qty;
//    }


/**
 * Get the Add On option setting
 * return the setting as array
 * array usage:
 * $setting = ['add_on_id' =>
 *                  [''option_no" =>
 *                          ['setting=>$settingValue,
 *                          'note'=>$note Value]
 *                  ]
 *              ]
 * @param $group_id
 * @return array
 */
//    protected function getOriginalAddOnOptionSetting($group_id)
//    {
//        //1. 把相同group資料抓起來
//        $addOnRowIds = Cart::search(['groupid' => $group_id, 'type' => 'add_on']);
//
//        //如果沒有設定 就傳回空的資料
//        if (!$this->hasAddOn($addOnRowIds)) {
//            return [];
//        }
//
//        //2. 把setting轉成 array
//        $addOnOptionSetting = [];
//
//        foreach ($addOnRowIds as $index => $rowId) {
//            $add_on = Cart::get($rowId);
//            $addOnOptionSetting[$add_on->id] =
//                $this->deserializeSetting($add_on->options->setting);
//        };
//
//        return $addOnOptionSetting;
//    }


//    protected function makeOptionArray($optionSettings = null)
//    {
//        if (!$optionSettings == null) {
//            $optionArray = [];
//            foreach ($optionSettings as $optionString) {
//                $setting = $this->deserializeOneSetting($optionString);
//
//                $optionArray[$setting['no']] =
//                    [
//                        'setting' => $setting['setting'],
//                        'note' => $setting['note']
//                    ];
//            }
//            return $optionArray;
//        }
//    }


//    protected function deserializeSetting($optionSettingString)
//    {
//        $optionSettingArray = $this->getCleanOption($optionSettingString);
//
//        $optionArray = $this->makeOptionArray($optionSettingArray);
//
//        return $optionArray;
//    }
//
//
//    protected function deserializeOneSetting($optionString)
//    {
//        //setting format: "[%s]%s':%s'%s (%s),"
//
//        //編號
//        $noStart = strpos($optionString, '[') + 1;
//        $noEnd = strpos($optionString, ']');
//        $no = substr($optionString, ($noStart), ($noEnd - $noStart));
//
//
//        //設定值
//        //要找出 兩個 ' ' 的位置 setting value
//        $settingStart = stripos($optionString, "'") + 1;
//        $settingEnd = strripos($optionString, "'");
//        $setting = substr($optionString, ($settingStart), ($settingEnd - $settingStart));
//
//
//        //註解
//        //註解有可能是空的 需要檢查出來
//        $noteStart = strpos($optionString, '(') + 1;
//        $noteEnd = strpos($optionString, ')');
//
//        $note = ($noteEnd == null) ? '' : substr($optionString, ($noteStart), ($noteEnd - $noteStart));
//
//        $option = [
//            'no' => $no,
//            'setting' => $setting,
//            'note' => $note
//        ];
//
//        return $option;
//    }


/**
 * Convert the option string, and remove the null content option
 * @param $optionSettingString
 * @return \Illuminate\Support\Collection
 */
//    protected function getCleanOption($optionSettingString)
//    {
//        //Convert the setting string to option array
//        $settingOptionArray = collect(explode(',', $optionSettingString));
//
//        //clear up the null content option
//        foreach ($settingOptionArray as $index => $option) {
//            if ($option == '') {
//                $settingOptionArray->forget($index);
//            }
//        }
//
//        return $settingOptionArray;
//    }

/**
 * @param Request $request
 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
 */
//    public function update(Request $request)
//    {
////        $this->flushOldAddOnSetting($request->input('group-id'));
////
////        //所屬產品
////        $this->product = Product::find($request->input('product-id'));  //get the product instance, so that we know what add on are required
////
////        $this->persistAddOnSetting($request);
////        return redirect('cart');
//    }


//    protected function persistAddOnSetting(Request $request)
//    {
//        $group_id = $request->input('group-id');
//
//        //fetch all input to this object
//        $add_on_chosen_list = collect($request->input('add-on-chosen'));
//        $add_on_id_list = $request->input('add-on-id');
//        $add_on_unit_qty_list = $request->input('add-on-unit-qty');
//        $add_on_note_list = $request->input('add-on-note');
//
//        foreach ($add_on_id_list as $index => $add_on_id) {
//            if ($this->addOnIsChosen($add_on_chosen_list, $add_on_id)) {
//                $this->addAddOnToCart(
//                    $group_id,
//                    $add_on_id,
//                    $add_on_unit_qty_list[$index],
//                    $add_on_note_list[$index],
//                    $request);
//            }
//        }
//    }

//    private function addOnIsChosen($add_on_chosen_list, $add_on_id)
//    {
//        return $add_on_chosen_list->contains($add_on_id);
//    }

//    protected function getAddOnTotalQty($group_id, $unit_qty)
//    {
//        //數量控制
//        //數量需要與產品一致, 如不可更改項目 單位數量=1, 真正數量=1*產品數量
//        //可更改數量項目, 單位數量 = n, 真正數量 = n* 產品數量
//        $productRowId = Cart::search(['groupid' => $group_id, 'type' => 'product']);
//        $productRow = Cart::get($productRowId[0]);
//
//        return $unit_qty * $productRow->qty;
//    }
//
//
//    protected function addAddOnToCart($group_id, $add_on_id, $unit_qty, $note, $request)
//    {
//        $this->getSettingInput($add_on_id, $request);
//        $this->serializeOptionSetting();
//        $this->calculateOptionPrice($this->product->id, $add_on_id);
//        $this->addToCart($group_id, $add_on_id, $unit_qty, $note);
//    }
//
//
//    protected function flushOldAddOnSetting($group_id)
//    {
//        $addOnRowIds = Cart::search(['groupid' => $group_id, 'type' => 'add_on']);
//
//        if ($this->hasAddOn($addOnRowIds)) {
//            foreach ($addOnRowIds as $addOnRowId) {
//                Cart::remove($addOnRowId);
//            }
//        }
//    }
//
//
//    private function hasAddOn($addOnRowIds)
//    {
//        return $addOnRowIds;
//    }
//
//    protected function addToCart($group_id, $addOn_id, $unit_qty, $note)
//    {
//
//        $qty = $this->getAddOnTotalQty($group_id, $unit_qty);
//
//        //配件價格
//        $unit_price = $this->optionPrice;
//
//        Cart::associate('AddOn', 'App\Models\Product')
//            ->add(
//                [
//                    'id' => $addOn_id,
//                    'name' => AddOn::find($addOn_id)->title,
//                    'qty' => $qty,
//                    'price' => $unit_price,
//                    'options' => [
//                        'setting' => $this->optionSettingString,
//                        'unit_qty' => $unit_qty
//                    ],
//                    'groupid' => $group_id,
//                    'type' => 'add_on',
//                    'note' => $note
//                ]
//            );
//        return true;
//    }
//
//
//    /**
//     * Get the setting input value associate with this add on
//     * @param $add_on_id
//     * @param Request $request
//     * @return \Illuminate\Support\Collection
//     */
//    protected function getSettingInput($add_on_id, Request $request)
//    {
//        $this->settingInput = collect([]);
//
//        foreach ($this->add_on_setting_input_fields as $index => $field) {
//            $key = $field . "-" . $add_on_id;
//            $this->settingInput->put($index, $request->input($key));
//        }
//
//        return $this;
//    }
//
//
//    /**
//     * Convert the setting input to string
//     * @param $settingInput
//     * @return string
//     */
//    protected function serializeOptionSetting()
//    {
//        $settingDescriptionLength = count($this->settingInput['no']);
//        $settingNoChosen = collect($this->settingInput['chosenNo']);
//
//        $this->optionSettingString = '';
//
//        for ($settingIndex = 0; $settingIndex < $settingDescriptionLength; $settingIndex++) {
//            //如果這個設定有被選中
//            if ($settingNoChosen->contains($this->settingInput['no'][$settingIndex])) {
//                $this->optionSettingString .= $this->serializeOneSetting($settingIndex);
//            }
//        }
//
//        return $this;
//    }
//
//    protected function calculateOptionPrice($product_id, $add_on_id)
//    {
//        $this->optionPrice =
//            (new  AddOnPriceCalculator
//            ($product_id, $add_on_id, $this->settingInput))
//                ->getPrice();
//        return $this;
//    }
//
//    protected function serializeOneSetting($settingIndex)
//    {
//        $no = $this->settingInput['no'][$settingIndex];
//        $title = $this->settingInput['title'][$settingIndex];
//        $setting = $this->settingInput['setting'][$settingIndex];
//
//        //設定 setting 單位
//        //如果設定值是可以設定數字的 就要把單位加上去
//        $id = $this->settingInput['id'][$settingIndex];
//        $setting_unit = '';
//        $addOnOption = AddOnOption::find($id);
//        if ($addOnOption->quantity_change_allowed) {
//            $setting_unit = json_decode($addOnOption->setting_choices)[0];
//        }
//
//        //設定註解
//        //如果有註解時,就是註解不是空的,就要把註解左右放上括弧 '(註解)'
//        $note = $this->settingInput['note'][$settingIndex];
//        $note = ($note == '') ? '' : '(' . $note . ')';
//
//
//        $stringForOneSetting = sprintf(
//            $this->optionSettingFormat,
//            $no,
//            $title,
//            $setting,
//            $setting_unit,
//            $note);
//
//        return $stringForOneSetting;
//    }
//
//
//    /**
//     * Remove all Add on associated with the input item, which is a product item
//     * @param $item
//     */
//    public function removeAddOn($item)
//    {
//        $this->flushOldAddOnSetting($item->groupid);
//    }