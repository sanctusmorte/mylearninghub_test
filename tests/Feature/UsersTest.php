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
        $response = $this->get('/api/v1/users')->assertStatus(200);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll(['items', 'status'])
        );
    }
}
