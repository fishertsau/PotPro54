<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductFeatureTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function the_product_created_form_could_be_fetched_from_admin()
    {
        $response = $this->get(route('admin.products.create'));

        $response->assertSuccessful()
            ->assertSee('新增節能產品')
            ->assertSee('產品名稱');
    }


    /** @test */
    public function a_product_could_be_created_from_the_admin()
    {
        $newProductInput = [
            'title' => 'A new product'
        ];

        $response = $this->post(route('admin.products.store'), $newProductInput);

        $product = Product::first();

        $response->assertRedirect(route('admin.products.edit', $product->id));
        $this->assertEquals($newProductInput['title'], $product->title);
        $this->assertCount(1, Product::all());
    }


    /** @test */
    public function product_edit_form_could_be_visited()
    {
        $product = factory(Product::class)->create([
            'title' => 'Wonderful Product'
        ]);

        $response = $this->get(route('admin.products.edit', $product->id));

        $response->assertSuccessful()
            ->assertSee('Wonderful Product');
    }


    /** @test */
    public function product_could_be_updated_from_the_admin()
    {
        $product = factory(Product::class)->create([
            'title' => 'Old product title'
        ]);

        $updatedInfo = [
            'title' => 'new product title'
        ];

        $response = $this->put(route('admin.products.update', $product->id), $updatedInfo);

        $updatedProduct = $product->fresh();
        $response->assertRedirect(route('admin.products.index'));
        $this->assertEquals($product->id, $updatedProduct->id);
        $this->assertEquals($updatedInfo['title'], $updatedProduct->title);
    }


    /** @test */
    public function can_see_product_list_from_admin()
    {
        $response = $this->get(route('admin.products.index'));

        $response->assertSuccessful()
            ->assertSee('產品清單');
    }

    /** @test */
    public function can_see_product_detail_from_admin()
    {
        $product = factory(Product::class)->create();

        $response = $this->get(route('admin.products.show', $product->id));

        $response->assertSuccessful()
            ->assertSee($product->title);
    }
}
