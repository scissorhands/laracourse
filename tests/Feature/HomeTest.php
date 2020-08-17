<?php

namespace Tests\Feature;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/home');
        $response->assertSeeText("Welcome home");
        $response->assertSeeText("Get comfy");
    }
}
