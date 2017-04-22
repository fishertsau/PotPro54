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

    /** @test */
    public function can_create_product()
    {
        $newProductInput = [
            'title' => 'A new product'
        ];

        $product = $this->proRepo->create($newProductInput);
        $this->assertEquals($newProductInput['title'], $product->title);
        $this->assertCount(1, Product::all());
    }

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
