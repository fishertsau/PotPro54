<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Models\Marketing\Video;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group video
 */
class VideoTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testVisitVideos()
    {
        $response = $this->get('/videos');

        $response->assertStatus(200)
            ->assertSee('影音列表');
    }


    /**
     * @test
     */
    public function visitVideoDetail()
    {
        $video = factory(Video::class)->create([
            'title' => 'ANewVideo'
        ]);

        $response = $this->get('/videos/' . $video->id);

        $response->assertStatus(200)
            ->assertSee($video->title);
    }

    /**
     * @test
     */
    public function redirectedIfWrongDetailIsVisited()
    {
        factory(Video::class, 1)->create();

        $response = $this->get("/videos/2");

        $response->assertStatus(404)
            ->assertSee('您要找的資料或是頁面無法找到');
    }


    /**
     * @test
     */
    public function can_get_create_form()
    {
        $response = $this->get('admin/videos/create');

        $response->assertStatus(200)
            ->assertSee('新增影音');
    }


    /**
     * @test
     */
    public function can_be_created_by_an_user()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $videoInput = [
            'title' => 'A New Video',
            'active' => true,
            'youtube_url' => 'someURL',
            'body' => 'description of a video',
        ];

        $response = $this->post('admin/videos/', $videoInput);

        $response->assertStatus(302)
            ->assertRedirect('admin/videos');

        $video = Video::first();
        $this->assertCount(1, Video::all());
        $this->assertEquals('A New Video', $video->title);
        $this->assertEquals(true, $video->active);
        $this->assertEquals('someURL', $video->youtube_url);
        $this->assertEquals('description of a video', $video->body);
    }


    /**
     * @test
     */
    public function can_update_video()
    {
        //arrange

        //act

        //assert
    }


    /**
     * @test
     */
    public function can_delete_video()
    {
        //arrange

        //act

        //assert
    }

    /**
     * @test
     */
    public function only_authorized_person_can_CRUD()
    {
        //todo: The test should be implemented after the Authorization control is implemented.

        //arrange

        //act

        //assert
    }


    /**
     * @test
     */
    public function can_see_video_list_from_admin()
    {
        $response = $this->get("/admin/videos");

        $response->assertStatus(200)
            ->assertSee('影音清單');
    }

    /**
     * @test
     */
    public function can_see_video_detail_from_admin()
    {
        $video = factory(Video::class)->create([
            'title' => 'ANewVideo'
        ]);

        $response = $this->get('/admin/videos/' . $video->id);

        $response->assertStatus(200)
            ->assertSee('影音')
            ->assertSee($video->title);
    }


    /**
     * @test
     */
    public function can_filter_videos_from_admin()
    {
        //arrange
        $activeVideoQty = random_int(1, 10);
        factory(Video::class, $activeVideoQty)->states('active')->create();

        $inActiveVideoQty = random_int(1, 10);
        factory(Video::class, $inActiveVideoQty)->states('inactive')->create();

        //act + assert
        $queryResult = $this->json('post', '/admin/videos/list/paginated',
            ['queryTerm' =>
                ['active' => true]
            ]);

        $this->assertCount($activeVideoQty, $queryResult->json()['data']);

        //act + assert
        $queryResult = $this->json('post', '/admin/videos/list/paginated',
            ['queryTerm' =>
                ['active' => false]
            ]);
        $this->assertCount($inActiveVideoQty, $queryResult->json()['data']);
    }
}
