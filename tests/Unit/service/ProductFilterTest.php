<?php

namespace Tests\Unit\Service;

use App;
use Tests\TestCase;
use App\Models\Product\Product;
use Acme\Tool\Filterable\ProductFilter;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group video
 * */
class ProductFilterTest extends TestCase
{
    use DatabaseMigrations;

    private $productFilter;

    /** @before */
    function setUpItem()
    {
        $this->productFilter = App::make(ProductFilter::class);
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function products_could_be_queried_with_published_status()
    {
        $publishedProductQty = random_int(1, 10);
        factory(Product::class, $publishedProductQty)
            ->states('published')
            ->create();

        $unpublishedProductQty = random_int(1, 10);
        factory(Product::class, $unpublishedProductQty)
            ->states('unpublished')
            ->create();

        //status
        //act + assert
        $queryResult = $this->productFilter->getList(['published' => true]);
        $this->assertCount($publishedProductQty, $queryResult);

        //act + assert
        $queryResult = $this->productFilter->getList(['published' => false]);
        $this->assertCount($unpublishedProductQty, $queryResult);
    }

    /**
     * @test
     */
    public function products_could_be_queried_with_keyword()
    {
        $productQtyWithTitle1 = random_int(1, 10);
        factory(Product::class, $productQtyWithTitle1)
            ->create([
                'title' => 'Super Title'
            ]);

        $productQtyWithTitle2 = random_int(1, 10);
        factory(Product::class, $productQtyWithTitle2)
            ->create([
                'title' => 'Great title'
            ]);

        //status
        //act + assert
        $queryResult = $this->productFilter->getList(['keyword' => 'Super']);
        $this->assertCount($productQtyWithTitle1, $queryResult);

        //act + assert
        $queryResult = $this->productFilter->getList(['keyword' => 'Great']);
        $this->assertCount($productQtyWithTitle2, $queryResult);
    }

    //Todo: implement query by product group
}
