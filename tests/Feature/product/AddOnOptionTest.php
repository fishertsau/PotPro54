<?php

namespace Tests;

use App\Models\Product\AddOnOption;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddOnOptionTestTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function addOn_option_could_be_listed_from_the_admin()
    {
        $response = $this->get(route('admin.addonOptions.index'));

        $response->assertSuccessful()
            ->assertSee('加工方式清單');
    }

    /** @test */
    public function addon_options_create_page_could_be_visited_form_admin()
    {
        $response = $this->get(route('admin.addonOptions.create'));

        $response->assertSuccessful()
            ->assertSee('新增加工方式');
    }


    /** @test */
    public function an_addOn_option_could_be_created_from_the_admin()
    {
        $newAddOnOptionInput = [
            'title' => 'A new AddOnOption Option',
        ];

        $response = $this->post(route('admin.addonOptions.store'),
            $newAddOnOptionInput);

        $addOnOption = AddOnOption::first();

        $response->assertRedirect(route('admin.addonOptions.edit', $addOnOption->id));
        $this->assertEquals($newAddOnOptionInput['title'], $addOnOption->title);
        $this->assertCount(1, AddOnOption::all());
    }


    /** @test */
    public function addOn_option_edit_form_could_be_visited_from_admin()
    {
        $addOnOption = factory(AddOnOption::class)->create([
            'title' => 'Wonderful AddOnOption'
        ]);

        $response = $this->get(route('admin.addonOptions.edit', $addOnOption->id));

        $response->assertSuccessful()
            ->assertSee('Wonderful AddOnOption');
    }

    /** @test */
    public function addon_option_could_be_updated_from_the_admin()
    {
        $addOnOption = factory(AddOnOption::class)->create([
            'title' => 'Old AddOnOption title'
        ]);

        $updatedInfo = [
            'title' => 'new AddOnOption title'
        ];

        $response = $this->put(route('admin.addonOptions.update', $addOnOption->id), $updatedInfo);

        $updatedAddOnOption = $addOnOption->fresh();
        $response->assertRedirect(route('admin.addonOptions.index'));
        $this->assertEquals($addOnOption->id, $updatedAddOnOption->id);
        $this->assertEquals($updatedInfo['title'], $updatedAddOnOption->title);
    }


    /** @test */
    public function can_see_addon_Option_detail_from_admin()
    {
        $addOnOption = factory(AddOnOption::class)->create();

        $response = $this->get(route('admin.addonOptions.show', $addOnOption->id));

        $response->assertSuccessful()
            ->assertSee($addOnOption->title);
    }
}