<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

/**
 * @group browser
 */
class HomePageTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testVisitHomePage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('歡迎來到鍋教授')
                ->assertSee('節能案例')
                ->assertSee('關於鍋教授')
                ->assertSee('與我們聯絡')
                ->assertSee('御鼎節能科技(股)有限公司')
                ->assertSee('台中市烏日區五光路復光六巷141號')
                ->assertSee('power0923393113@yahoo.com.tw')
                ->assertSee('04-3507 9900')
                ->assertSee('04-2336 9277');
        });
    }

    public function testVisitContent()
    {
        $this->browse(function (Browser $browser) {

            //日常瓦斯節能
            $browser->visit('/')
                ->click("#showGasSavingInLivingEnvironment")
                ->assertSee('日常瓦斯節能');

            //節能鍋原理
            $browser->visit('/')
                ->click('#showGasSavingDesignPrinciple')
                ->assertSee('節能鍋原理');

            //聯絡我們
            $browser->visit('/')
                ->click('#showCustomerServiceSelection')
                ->click('#showContactUsForm')
                ->assertSee('聯絡我們');
        });
    }
}
