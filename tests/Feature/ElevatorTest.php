<?php

namespace Tests\Feature;

use App\Domain\ElevatorRequest;
use App\Events\TurnOnElevators;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ElevatorTest extends TestCase
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
    public function testTurnOnAll()
    {
        $this->withoutExceptionHandling();

        $response = $this->put('/api/elevators/all/turn-on')->assertStatus(200);
    }

}
