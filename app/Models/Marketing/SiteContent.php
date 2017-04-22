<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    protected $table = 'site_content';

    protected static $contentTitleByMajorCategory = [
        //關於公司
        'aboutUs' =>
            [
            'story' => '我們的故事',
            'pro_service' => '產品與服務',
            'com_info' => '公司資訊'
        ],

        //瓦斯節能設計原理
        'gasSavingDesignPrinciple' => [
            'design_principle' => '節能鍋設計原則',
            'pipe_design' => '斜管鍋原理',
            'nail_design' => '銅釘鍋原理',
            'flake_design' => '鋁鰭片鍋原理',
            'real_case_design' => '節能效果案例'
        ],

        //日常瓦斯節能
        'lifeGasSaving' => [
            'normal_case' => '常見瓦斯浪費',
            'effect' => '瓦斯浪費影響',
            'benefit' => '瓦斯節能好處',
            'pitfall' => '常見錯誤',
            'check' => '判斷有浪費',
            'how_to' => '如何省瓦斯',
            'real_case_saving' => '瓦斯節能案例',
            'reference' => '參考資料'
        ]
    ];

    protected static $contentCategoryDescription =[
        'aboutUs' => '關於我們',
        'lifeGasSaving' => '日常瓦斯節能',
        'gasSavingDesignPrinciple' => '節能鍋原理'
    ];

    protected $fillable = [
        'title',
        'body',
        'description'
    ];


    public static function  getContentListByMajorCategory($category)
    {
        return self::$contentTitleByMajorCategory[$category];
    }


    public static function getCategoryDescription($category){
        return self::$contentCategoryDescription[$category];
    }
}
