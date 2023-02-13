<?php

namespace Tests\Feature;

use App\Models\OccupationAttributes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected OccupationAttributes $occupation;

    public function setUp(): void
    {
        parent::setUp();

        $this->occupation = OccupationAttributes::factory()->create(['name' => 'occupation']);
    }

    public function test_should_create_user(): void
    {
        $data = [
            'name' => 'same_name',
            'occupation' => $this->occupation->name
        ];

        $this->post('/api/user', $data)->assertOk();

        $this->assertDatabaseHas('users', ['name' => 'same_name']);
    }

    public function test_should_message_erro_on_create_user_with_occupation_not_found(): void
    {
        $data = [
            'name' => 'same_name',
            'occupation' => 'same_occupation'
        ];

        $response = $this->post('/api/user', $data)->assertOk();
        $this->assertEquals('The selected occupation is invalid.', json_decode($response->getContent())->messages[0]);
    }

    public function test_should_retrieve_all_users(): void
    {
        $data = [
            [
                'name' => 'same_name',
                'occupation' => $this->occupation->name
            ], [
                'name' => 'other_name',
                'occupation' => $this->occupation->name
            ]
        ];

        foreach ($data as $user) {
            $this->post('/api/user', $user);
        }

        $response = $this->get('/api/user')->assertOk();

        $this->assertEquals($data[0]['name'], json_decode($response->getContent())[0]->name);
        $this->assertEquals($data[1]['name'], json_decode($response->getContent())[1]->name);
    }

    public function test_should_retrieve_specific_user(): void
    {
        $data = [
            [
                'name' => 'same_name',
                'occupation' => $this->occupation->name
            ], [
                'name' => 'other_name',
                'occupation' => $this->occupation->name
            ]
        ];

        foreach ($data as $user) {
            $this->post('/api/user', $user);
        }

        $response1 = $this->get('/api/user/1')->assertOk();
        $response2 = $this->get('/api/user/2')->assertOk();

        $this->assertEquals($data[0]['name'], json_decode($response1->getContent())->name);
        $this->assertEquals($data[1]['name'], json_decode($response2->getContent())->name);
    }

    public function test_should_retrieve_message_exception_on_get_user(): void
    {
        $response = json_decode($this->get('/api/user/1')->getContent());
        $this->assertEquals('Personagem não encontrado', $response->error);
    }
}
