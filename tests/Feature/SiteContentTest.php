<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * @group siteContent
 */
class SiteContentTest extends TestCase
{
    public function testVisitAboutUs()
    {
        $response = $this->get('/aboutUs');

        $response->assertStatus(200)
            ->assertSee('關於我們');
    }

    public function testVisitGasSavingInLivingEnvironment()
    {
        $response = $this->get('/gasSavingInLivingEnvironment');

        $response->assertStatus(200)
            ->assertSee('日常瓦斯節能');
    }

    public function testVisitGasSavingDesignPrinciple()
    {
        $response = $this->get('/gasSavingDesignPrinciple');

        $response->assertStatus(200)
            ->assertSee('日常瓦斯節能');
    }

    public function testVisitContactUs()
    {
        $response = $this->get('/contactUs');

        $response->assertStatus(200)
            ->assertSee('聯絡我們');
    }



    public function testSendContactUs()
    {
//        $this->assertNotPushed(ContactUsMail::class);

        $contactUsInfo = [
            'contact' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '0266668888',
            'topic' => '合作提案',
            'content' => 'contactUs content'
        ];

        $response = $this->post('/contactUs', $contactUsInfo);

        $response->assertStatus(302)
            ->assertRedirect('/');

//        $this->assertPushed(ContactUsMail::class);
        //todo: assert an email was sent
    }

    //todo: contact us form field validation


    /**
     * @test
     */
    public function testSeeServiceTerm()
    {
        $response = $this->get('/terms/sign-up');

        $response->assertStatus(200)
            ->assertSee('服務條款');
    }

    /**
    *@test
    */
    public function testCanNotGetUnknownTerms(){
        $response = $this->get('/terms/doesnot-exists');

        $response->assertStatus(404)
            ->assertSee('您要找的資料或是頁面無法找到');
    }

    //todo: siteContent admin function test
}
