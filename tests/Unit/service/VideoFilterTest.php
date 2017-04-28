<?php

namespace Tests\Unit\Service;

use App;
use Tests\TestCase;
use App\Models\Marketing\Video;
use Acme\Tool\Filterable\VideoFilter;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group video
 * */
class VideoFilterTest extends TestCase
{
    use DatabaseMigrations;

    private $videoFilter;

    /** @before */
    function setUpItem()
    {
        $this->videoFilter = App::make(VideoFilter::class);
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function videos_could_be_queried_with_status()
    {
        $activeVideoQty = random_int(1, 10);
        factory(Video::class, $activeVideoQty)
            ->states('active')
            ->create();

        $inActiveVideoQty = random_int(1, 10);
        factory(Video::class, $inActiveVideoQty)
            ->states('inactive')
            ->create();

        //status
        //act + assert
        $queryResult = $this->videoFilter->getList(['active' => true]);
        $this->assertCount($activeVideoQty, $queryResult);

        //act + assert
        $queryResult = $this->videoFilter->getList(['active' => false]);
        $this->assertCount($inActiveVideoQty, $queryResult);
    }

    /**
     * @test
     */
    public function videos_could_be_queried_with_keyword()
    {
        $newVideoQtyWithTitle1 = random_int(1, 10);
        factory(Video::class, $newVideoQtyWithTitle1)
            ->create([
                'title' => 'Super Title'
            ]);

        $newVideoQtyWithTitle2 = random_int(1, 10);
        factory(Video::class, $newVideoQtyWithTitle2)
            ->create([
                'title' => 'Great title'
            ]);


        //status
        //act + assert
        $queryResult = $this->videoFilter->getList(['keyword' => 'Super']);
        $this->assertCount($newVideoQtyWithTitle1, $queryResult);

        //act + assert
        $queryResult = $this->videoFilter->getList(['keyword' => 'Great']);
        $this->assertCount($newVideoQtyWithTitle2, $queryResult);
    }


    /**
     * @test
     */
    public function inActive_items_can_only_be_filtered_from_admin()
    {
        //
        $this->disableExceptionHandling();

        //arrange

        //act

        //assert
    }
}
