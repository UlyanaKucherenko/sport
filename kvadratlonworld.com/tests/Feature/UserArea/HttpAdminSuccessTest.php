<?php

namespace Tests\Feature\UserArea;

use Tests\AuthEnv;
use Tests\TestCase;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HttpAdminSuccessTest extends TestCase
{
    use AuthEnv;

    public function testBaseRoute()
    {
        $this->createUser();
        $this->actingAs($this->user)
            ->get('/member_area/')
            ->assertStatus(302);
    }

    public function testProfileRoute()
    {
        $this->createUser();
        $this->actingAs($this->user)
            ->get('/member_area/profile')
            ->assertStatus(200);
    }

    public function testDashboardRoute()
    {
        $this->createUser();
        $this->actingAs($this->user)
            ->get('/member_area/dashboard')
            ->assertStatus(200);
    }

    public function testManageRoute()
    {
        $this->createUser();
        $this->actingAs($this->user)
            ->get('/member_area/manage')
            ->assertStatus(200);
    }

    public function testCoachRoute()
    {
        $this->createUser();
        $this->actingAs($this->user)
            ->get('/member_area/coach')
            ->assertStatus(200);
    }
}
