<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product\AddOn;
use App\Models\Product\Group;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group group
 */
class GroupTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    /** @test */
    public function groups_could_be_listed_from_the_admin()
    {
        $response = $this->get(route('admin.groups.index'));

        $response->assertSuccessful()
            ->assertSee('系列清單');
    }

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
    public function group_edit_form_could_be_visited_from_admin()
    {
        $group = factory(Group::class)->create([
            'title' => 'Wonderful Group'
        ]);

        $response = $this->get(route('admin.groups.edit', $group->id));

        $response->assertSuccessful()
            ->assertSee('Wonderful Group');
    }

    /** @test */
    public function group_could_be_updated_from_the_admin()
    {
        factory(AddOn::class, 5)->create();
        $group = factory(Group::class)->create([
            'title' => 'Old group title'
        ]);


        $updatedInfo = [
            'title' => 'new group title',
            'add_on_list' => [1, 3, 5]
        ];

        $response = $this->put(route('admin.groups.update', $group->id), $updatedInfo);

        $updatedGroup = $group->fresh();
        $response->assertRedirect(route('admin.groups.index'));
        $this->assertEquals($group->id, $updatedGroup->id);
        $this->assertEquals($updatedInfo['title'], $updatedGroup->title);
        $this->assertEquals([1, 3, 5], $updatedGroup->addOnables->pluck('id')->toArray());
    }


    /** @test */
    public function can_see_product_detail_from_admin()
    {
        $group = factory(Group::class)->create();

        $response = $this->get(route('admin.groups.show', $group->id));

        $response->assertSuccessful()
            ->assertSee($group->title);
    }


    /** @test */
    public function could_query_groups_from_admin()
    {
        $publishedGroupQty = random_int(5, 10);
        $unpublishedGroupQty = random_int(5, 10);

        factory(Group::class, $publishedGroupQty)->states('published')->create([
            'title' => 'Super Group'
        ]);
        factory(Group::class, $unpublishedGroupQty)->states('unpublished')->create([
            'title' => 'Super Group'
        ]);

        //arrange
        $queryTerm = ['queryTerm' => [
            'published' => true,
            'keyword' => 'Super'
        ]];

        //act
        $queryResult = $this->post(route('admin.groups.list'), $queryTerm);

        //assert
        $this->assertCount($publishedGroupQty, $queryResult->json()['data']);
    }

    /** @test */
    public function title_is_required_to_create_a_new_group()
    {
        $newGroupInput = [
        ];

        $response = $this->post(route('admin.groups.store'), $newGroupInput);

        $response->assertStatus(302)
            ->assertRedirect(route('admin.groups.create'));
    }

    //todo: subgroup_id is required to create a new group
}
