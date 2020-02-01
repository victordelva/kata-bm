<?php

namespace Tests\Feature;

use App\Domain\ElevatorRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ElevatorRequestTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    /**
     * Transform Secuence into request
     *
     * @return void
     */
    public function testTransformSequencesToRequest()
    {
        $this->withoutExceptionHandling();

        $response = $this->put('/api/sequences/all/transform');

        $this->assertDatabaseHas('sequence_elevator_requests', ['id' => 1]);
        $this->assertDatabaseHas('elevator_requests', ['id' => 1]);

        $this->get('/api/requests')->assertStatus(200);

        $response->assertStatus(200);
    }

}
