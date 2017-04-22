<?php

namespace App\Http\Controllers\FrontEnd\Cart;

use App\Models\Product\AddOn;
use App\Models\Product\Product;

class AddOnPriceCalculator
{
    private static $addOn_PriceCalculatorFunction = [
        '水平式洩水閥' => 'horizontalValvePrice',
        '垂直式洩水閥' => 'verticalValvePrice',
        '網籃' => 'nestBasketPrice',
        '底網' => 'bottomNest',
        '平湯鍋蓋' => 'potCap'
    ];

    private $product;
    private $addOn;
    private $setting;
    private $fees = [];

    //洩水閥費用表
    protected $valveBaseFee = [
        '1/2英吋(4分)' => 500,
        '3/4英吋(6分)' => 600,
        '1英吋' => 800,
        '1英吋半' => 1200,
    ];


    /**
     * AddOnPriceCalculator constructor.
     * @param $product_id
     * @param $add_on_id
     * @param $setting
     */
    public function __construct($product_id, $add_on_id, $setting)
    {
        $this->product = Product::find($product_id);
        $this->addOn = AddOn::findOrFail($add_on_id);
        $this->setting = $this->convertSetting($setting);
        $this->fees = [];
    }

    protected function convertSetting($setting)
    {
        $choseNoList = $this->getChosenSetting($setting);
        $convertedSetting = [];
        foreach ($setting['no'] as $index => $no) {
            if ($this->settingIsChosen($choseNoList, $no)) {
                $convertedSetting[$no] = $setting['setting'][$index];
            }
        }

        return $convertedSetting;
    }


    public function getPrice()
    {
        $calculator = $this->getCorrespondingAddOnPriceCalculator();

        return $this->{$calculator}();
    }


    protected function getCorrespondingAddOnPriceCalculator()
    {
        return static::$addOn_PriceCalculatorFunction[$this->addOn->title];
    }


    protected function bottomNest()
    {
        //底網
        //A1:網孔大小
        //A2:把手位置
        //A3:角柱高

        //底網標準費用
        $baseFee = [
            '36' => 490,
            '42' => 560,
            '45' => 610,
            '48' => 780,
            '54' => 1010,
            '60' => 1060
        ];

        //產品直徑
        $productDiameter = $this->product->diameter;

        //底網基本費
        $this->addToFees($baseFee[$productDiameter]);

        //A2:把手位置
        if ($this->setting['A2'] === '雙邊把手') {
            $this->addToFees(60);
        }

        return $this->netTotal();
    }

    //鍋蓋
    protected function potCap()
    {
        //網籃基本費用表
        $baseFee = [
            '36' => 235,
            '42' => 315,
            '48' => 380,
            '54' => 420,
            '60' => 505,
        ];

        //產品直徑
        $productDiameter = $this->product->diameter;

        //網籃基本費
        $this->addToFees($baseFee[$productDiameter]);

        //A1:鍋蓋加工
        switch ($this->setting['A1']) {
            case "U型把手":
                $capHandling = 100;
                break;
            case "鍋蓋插邊":
                $capHandling = 200;
                break;
            case "U型把手+鍋蓋插邊":
                $capHandling = 300;
                break;
            default:
                $capHandling = 0;
        }

        $this->addToFees($capHandling);

        return $this->netTotal();
    }

    protected function horizontalValvePrice()
    {
        //水平洩水閥
        //A1:洩水閥預設長度
        //A2:洩水閥尺寸
        //A3:長度
        //B1:洩水閥位置
        //(1)洩水閥
        $this->addToFees(
            $this->valveBaseFee[$this->setting['A2']]);

        //(2)支撐架費用
        $this->addToFees(($this->setting['A1'] == '9公分(含加強支撐)') ? 100 : 0);

        //(3)長度
        $this->addToFees(($this->setting['A3'] > 5) ? 200 : 0);

        return $this->netTotal();
    }


    protected function verticalValvePrice()
    {
        //垂直洩水閥
        //A1:長度
        //A2:洩水閥尺寸
        //B1:洩水閥位置

        //長度
        if ($this->setting['A1'] > 13) {
            $this->addToFees(200);
        }

        //(1)洩水閥
        $this->addToFees($this
            ->valveBaseFee[$this->setting['A2']]);

        return $this->netTotal();
    }

    protected function nestBasketPrice()
    {
        //網籃基本費用表
        $baseFee = [
            '36' => 730,
            '42' => 1000,
            '48' => 1470,
            '54' => 1800,
            '60' => 1950,
        ];

        $heightBaseFee = [
            '36' => 42,
            '42' => 49,
            '48' => 63,
            '54' => 70,
            '60' => 84,
        ];

        //A1:高度
        //A2:網孔大小
        //Y:網籃手把

        //產品直徑
        $productDiameter = $this->product->diameter;

        //網籃基本費
        $this->addToFees($baseFee[$productDiameter]);

        //增高費用
        if ($this->setting['A1'] > 15) {
            $this->addToFees($heightBaseFee[$productDiameter] * ($this->setting['A1'] - 15));
        }

        //手把費用
        switch ($this->setting['Y']) {
            case "單提籃式":
                $this->addToFees(200);
                break;
            case "雙提籃式":
                $this->addToFees(400);
                break;
            case "雙把手式":
                $this->addToFees(120);
                break;
        }

        return $this->netTotal();
    }

    /**
     * @param $setting
     * @return \Illuminate\Support\Collection
     */
    protected function getChosenSetting($setting)
    {
        return collect($setting['chosenNo']);
    }

    /**
     * @param $choseNoList
     * @param $no
     * @return mixed
     */
    protected function settingIsChosen($choseNoList, $no)
    {
        return $choseNoList->contains($no);
    }

    /**
     * @param $total
     * @return mixed
     */
    protected function salesCapOnPrice($total)
    {
        //業務加成
        $salesAddOnRatio = (auth()->user()->sales->role == '公司業務') ? 1.2 : 1;

        $netTotal = $total * $salesAddOnRatio;
        return $netTotal;
    }


    protected function totalHandlingFee($fee)
    {
        return array_reduce($fee, function ($start = 0, $oneItemFee) {
            return $start += $oneItemFee;
        });
    }

    /**
     * @param $fee
     * @return mixed
     */
    protected function netTotal()
    {
        $total = $this->totalHandlingFee($this->fees);
        $netTotal = $this->salesCapOnPrice($total);
        return $netTotal;
    }

    protected function addToFees($fee = 0)
    {
        $this->fees[] = $fee;
    }

}