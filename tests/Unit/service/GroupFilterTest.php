<?php

namespace Tests\Unit\Service;

use App;
use App\Models\Product\Group;
use Tests\TestCase;
use Acme\Tool\Filterable\GroupFilter;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group video
 * */
class GroupFilterTest extends TestCase
{
    use DatabaseMigrations;

    private $groupFilter;

    /** @before */
    function setUpItem()
    {
        $this->groupFilter = App::make(GroupFilter::class);
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function groups_could_be_queried_with_published_status()
    {
        $publishedGroupQty = random_int(1, 10);
        factory(Group::class, $publishedGroupQty)
            ->states('published')
            ->create();

        $unpublishedGroupQty = random_int(1, 10);
        factory(Group::class, $unpublishedGroupQty)
            ->states('unpublished')
            ->create();

        //status
        //act + assert
        $queryResult = $this->groupFilter->getList(['published' => true]);
        $this->assertCount($publishedGroupQty, $queryResult);

        //act + assert
        $queryResult = $this->groupFilter->getList(['published' => false]);
        $this->assertCount($unpublishedGroupQty, $queryResult);
    }

    /**
     * @test
     */
    public function groups_could_be_queried_with_keyword()
    {
        $groupQtyWithTitle1 = random_int(1, 10);
        factory(Group::class, $groupQtyWithTitle1)
            ->create([
                'title' => 'Super Title'
            ]);

        $groupQtyWithTitle2 = random_int(1, 10);
        factory(Group::class, $groupQtyWithTitle2)
            ->create([
                'title' => 'Great title'
            ]);

        //status
        //act + assert
        $queryResult = $this->groupFilter->getList(['keyword' => 'Super']);
        $this->assertCount($groupQtyWithTitle1, $queryResult);

        //act + assert
        $queryResult = $this->groupFilter->getList(['keyword' => 'Great']);
        $this->assertCount($groupQtyWithTitle2, $queryResult);
    }
}
