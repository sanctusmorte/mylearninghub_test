<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UsersTest extends TestCase
{
    public function testGetList()
    {
        $response = $this->get('/api/v1/users?token=0a68d206-d271-47da-846f-07ec94075f6c')->assertStatus(200);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll(['items', 'status'])
        );
    }
}
