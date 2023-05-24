<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class EnrollmentsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAvailableStatuses()
    {
        $response = $this->get('/api/v1/enrollments/available-statuses?token=0a68d206-d271-47da-846f-07ec94075f6c')->assertStatus(200);
    }

    public function testInvalidStatusForGetList()
    {
        $this->get('/api/v1/enrollments?status=invalid&token=0a68d206-d271-47da-846f-07ec94075f6c')
            ->assertStatus(200)
            ->assertJsonFragment([
                'errors' => [
                    'status' => 'The selected status is invalid.'
                ],
                'status' => 'error',
                'error_message' => 'wrong_params',
            ]);
    }

    public function testEditValidationBody()
    {
        $this->putJson('/api/v1/enrollments', ['test' => 'test'])
            ->assertStatus(200)
            ->assertJsonFragment([
                'errors' => [
                    'id' => 'The id field is required.',
                    'status' => 'The status field is required.',
                ],
                'status' => 'error',
                'error_message' => 'wrong_params',
            ]);
    }

    public function testEdit()
    {
        $this->putJson('/api/v1/enrollments', ['id' => 2, 'status' => 'in_progress'])
            ->assertStatus(200)
            ->assertJsonFragment([
                'status' => 'success',
            ]);
    }

    public function testDeleteValidation()
    {
        $this->deleteJson('/api/v1/enrollments', [])
            ->assertStatus(200)
            ->assertJsonFragment([
                'errors' => [
                    'id' => 'The id field is required.',
                ],
                'status' => 'error',
                'error_message' => 'wrong_params',
            ]);
    }

    public function testCreateValidation()
    {
        $this->postJson('/api/v1/enrollments', ['id' => 1, 'status' => 'in_progress'])
            ->assertStatus(200)
            ->assertJsonFragment([
                'errors' => [
                    'user_id' => 'The user id field is required.',
                    'course_id' => 'The course id field is required.',
                ],
                'status' => 'error',
                'error_message' => 'wrong_params',
            ]);
    }

    public function testGetList()
    {
        $response = $this->get('/api/v1/enrollments?page=1&limit=20&token=0a68d206-d271-47da-846f-07ec94075f6c')->assertStatus(200);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll(['data', 'links', 'meta'])
        );
    }

    public function testGetListWithSort()
    {
        $response = $this->get('/api/v1/enrollments?page=1&limit=20&sort_column=id&sort_dir=desc&token=0a68d206-d271-47da-846f-07ec94075f6c')->assertStatus(200);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll(['data', 'links', 'meta'])
        );
    }

    public function testGetListWithSearch()
    {
        $response = $this->get('/api/v1/enrollments?page=1&limit=50&course_title=til&user_email=mak&token=0a68d206-d271-47da-846f-07ec94075f6c')->assertStatus(200);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll(['data', 'links', 'meta'])
        );
    }

    public function testGetListWithFilterByStatus()
    {
        $response = $this->get('/api/v1/enrollments?page=1&limit=50&status=complete&token=0a68d206-d271-47da-846f-07ec94075f6c')->assertStatus(200);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll(['data', 'links', 'meta'])
        );
    }
}
