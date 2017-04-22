<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class BecomeResellerTest extends TestCase
{
    public function testVisitBecomeResellerPage()
    {
        $user=factory(User::class)->make();

        $this->actingAs($user);

        $response = $this->get('/becomeReseller');

        $response->assertStatus(200)
            ->assertSee('加入經銷商')
            ->assertSee('經銷業務招募中');
    }

    /**
     * @test
     */
    public function redirect_to_login_if_unSignedIn_user_visit_becomeReseller_page()
    {
        $response = $this->get('/becomeReseller');

        $response->assertStatus(302)
            ->assertRedirect('/register');
    }

    //todo: create test for become Reseller post action
}
