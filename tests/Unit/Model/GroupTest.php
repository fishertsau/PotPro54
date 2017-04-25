<?php

namespace Tests;

use App\Models\Product\Group;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GroupTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_have_default_setting_when_created()
    {
        $group = Group::create(['title' => 'Group Title']);

        $this->assertEquals($group->published, false);
    }
}