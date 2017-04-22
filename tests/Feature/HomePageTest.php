<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testVisitHomePage()
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSee('歡迎來到鍋教授')
            ->assertSee('節能案例')
            ->assertSee('與我們聯絡')
            ->assertSee('御鼎節能科技(股)有限公司')
            ->assertSee('台中市烏日區五光路復光六巷141號')
            ->assertSee('power0923393113@yahoo.com.tw')
            ->assertSee('04-3507 9900')
            ->assertSee('04-2336 9277')
        ;
    }
}
