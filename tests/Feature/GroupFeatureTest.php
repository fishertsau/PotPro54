<?php

namespace Tests\Feature;

use App\Models\Product\Group;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\Product\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GroupFeatureTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    /** @test */
    public function group_create_page_could_be_visited_form_admin()
    {
        $response = $this->get(route('admin.groups.create'));

        $response->assertSuccessful()
            ->assertSee('系列名稱');
    }


    /** @test */
    public function a_product_could_be_created_from_the_admin()
    {
        $newGroupInput = [
            'title' => 'A new product',
        ];

        $response = $this->post(route('admin.groups.store'), $newGroupInput);

        $group = Group::first();

        $response->assertRedirect(route('admin.groups.edit', $group->id));
        $this->assertEquals($newGroupInput['title'], $group->title);
        $this->assertCount(1, Group::all());
    }


    /** @test */
//    public function product_edit_form_could_be_visited()
//    {
//        $this->disableExceptionHandling();
//        $group = factory(Product::class)->create([
//            'title' => 'Wonderful Product'
//        ]);
//
//        $response = $this->get(route('admin.groups.edit', $product->id));
//
//        $response->assertSuccessful()
//            ->assertSee('Wonderful Product');
//    }
//
//
//    /** @test */
//    public function product_could_be_updated_from_the_admin()
//    {
//        $product = factory(Product::class)->create([
//            'title' => 'Old product title'
//        ]);
//
//        $updatedInfo = [
//            'title' => 'new product title'
//        ];
//
//        $response = $this->put(route('admin.products.update', $product->id), $updatedInfo);
//
//        $updatedProduct = $product->fresh();
//        $response->assertRedirect(route('admin.products.index'));
//        $this->assertEquals($product->id, $updatedProduct->id);
//        $this->assertEquals($updatedInfo['title'], $updatedProduct->title);
//    }
//
//
//    /** @test */
//    public function can_see_product_list_from_admin()
//    {
//        $response = $this->get(route('admin.products.index'));
//
//        $response->assertSuccessful()
//            ->assertSee('產品清單');
//    }
//
//    /** @test */
//    public function can_see_product_detail_from_admin()
//    {
//        $product = factory(Product::class)->create();
//
//        $response = $this->get(route('admin.products.show', $product->id));
//
//        $response->assertSuccessful()
//            ->assertSee($product->title);
//    }
//
//
//    /** @test */
//    public function could_query_products_from_admin()
//    {
//        $publishedProductQty = random_int(5, 10);
//        $unpublishedProductQty = random_int(5, 10);
//
//        factory(Product::class, $publishedProductQty)->states('published')->create([
//            'title' => 'Super Product'
//        ]);
//        factory(Product::class, $unpublishedProductQty)->states('unpublished')->create([
//            'title' => 'Super Product'
//        ]);
//
//        //arrange
//        $queryTerm = ['queryTerm' => [
//            'published' => true,
//            'keyword' => 'Super'
//        ]];
//
//        //act
//        $queryResult = $this->post(route('admin.products.list'), $queryTerm);
//
//        //assert
//        $this->assertCount($publishedProductQty, $queryResult->json()['data']);
//    }
//
//
//    /** @test */
//    public function title_is_required_to_create_a_new_product()
//    {
//        $newProductInput = [
//        ];
//
//        $response = $this->post(route('admin.products.store'), $newProductInput);
//
//        $response->assertStatus(302)
//            ->assertRedirect(route('admin.products.create'));
//    }
}
