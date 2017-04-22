<?php

use App\Models\Product\Group;
use App\Models\Product\GroupCategory;
use App\Models\Product\GroupSubCategory;
use Illuminate\Database\Seeder;

class CategoryGroupProductTableSeeder extends Seeder
{
    protected $productCompleteList;

    public function __construct()
    {
        $this->productCompleteList = json_decode(Storage::get('groupAndProductInfo.json'));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->productCompleteList as $mainCategory) {

            $groupCategoryInfo = [
                'title' => $mainCategory->mainCategoryTitle,
                'active' => 1,
            ];

            $groupCategoryEntry = factory(GroupCategory::class)->create($groupCategoryInfo);

            foreach ($mainCategory->subCategory as $subCategory) {
                $subCategoryInfo = [
                    "title" => $subCategory->title,
                    'active' => 1,
                    'group_category_id'=>$subCategory->id,
                ];

//                $subCategoryEntry = $groupCategoryEntry->groupSubCategories()->create($subCategoryInfo);
                $subCategoryEntry = factory(GroupSubCategory::class)->create($subCategoryInfo);
                foreach ($subCategory->groupItems as $group) {
                    $groupInfo = [
                        'title' => $group->title,
                        'coverPhoto_path' => $group->coverPhoto_path,
                        'active' => 1,
                        'add_on_allowed' => $group->add_on_allowed,

                    ];

                    $groupEntry = factory(Group::class)->create($groupInfo);

                    foreach ($group->productItems as $product) {
                        $productInfo = [
                            'title' => $product->title,
                            'coverPhoto_path' => $product->coverPhoto_path,
                            'active' => 1
                        ];

                        $groupEntry->products()->create($productInfo);
                    }
                }
            }
        }
    }
}
