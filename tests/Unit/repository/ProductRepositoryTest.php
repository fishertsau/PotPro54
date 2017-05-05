<?php

namespace Tests\Unit\Repository;

use App;
use Tests\TestCase;
use App\Models\Product\Product;
use Acme\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private $proRepo;

    function setUp()
    {
        parent::setUp();
        $this->proRepo = App::make(ProductRepository::class);
    }

    //todo: should decide if in product creation, group is necessary?
    /** @test */
//    public function should_be_created_through_group(){
//
//      //arrange
//
//      //act
//
//      //assert
//    }

    /** @test */
    public function can_update_product()
    {
        $product = factory(Product::class)->create([
            'title' => 'Old product title'
        ]);

        $updatedInfo = [
            'title' => 'new product title'
        ];

        $updatedProduct = $this->proRepo->update($product, $updatedInfo);
        $this->assertEquals($product->id, $updatedProduct->id);
        $this->assertEquals($updatedInfo['title'], $updatedProduct->title);
    }
}
