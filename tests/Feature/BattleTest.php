<?php

namespace Tests\Feature;

use App\Models\OccupationAttributes;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use function App\Helpers\getMageAttributes;
use function App\Helpers\getWarriorAttributes;

class BattleTest extends TestCase
{
    use RefreshDatabase;

    protected $user1;
    protected $user2;
    protected OccupationAttributes $occupationWarrior;
    protected OccupationAttributes $occupationMage;

    public function setUp(): void
    {
        parent::setUp();

        $this->occupationWarrior = OccupationAttributes::factory()->create(getWarriorAttributes());
        $this->occupationMage = OccupationAttributes::factory()->create(getMageAttributes());

        $this->user1 = $this->post('/api/user',  [
            'name' => 'same_name',
            'occupation' => $this->occupationWarrior->name
        ]);

        $this->user2 = $this->post('/api/user',  [
            'name' => 'other_name',
            'occupation' => $this->occupationMage->name
        ]);
    }

    public function test_should_retrieve_error_char_dead()
    {
        $user1Id = json_decode($this->user1->getContent())->id;
        $user2Id = json_decode($this->user2->getContent())->id;

        User::find($user2Id)->update(['life_points' => 0]);

        $response = $this->post("/api/battle/{$user1Id}/{$user2Id}")->getContent();

        $this->assertEquals('Um ou mais persoangem está sem vida.', json_decode($response)->message);
    }

    public function test_json_structure_battle_logs()
    {
        $user1Id = json_decode($this->user1->getContent())->id;
        $user2Id = json_decode($this->user2->getContent())->id;

        $this->post("/api/battle/{$user1Id}/{$user2Id}")
            ->assertJsonStructure(
                [
                    [
                        'id',
                        'log',
                        'identifier',
                        'created_at',
                        'updated_at'
                    ]
                ]
            );
    }

    public function test_should_have_one_of_the_dead_characters()
    {
        $user1 = $this->post('/api/user',  [
            'name' => 'other_same_name',
            'occupation' => $this->occupationWarrior->name
        ]);

        $user2 = $this->post('/api/user',  [
            'name' => 'other_name_',
            'occupation' => $this->occupationMage->name
        ]);

        $user1Id = json_decode($user1->getContent())->id;
        $user2Id = json_decode($user2->getContent())->id;

        $this->post("/api/battle/{$user1Id}/{$user2Id}")->getContent();
        
        $user1 = User::find($user1Id);
        $user2 = User::find($user2Id);

        $this->assertTrue($user1->life_points == 0 xor $user2->life_points == 0);
    }
}
