<?php

use App\Domain\SequenceElevatorRequest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SequenceElevatorRequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertSequence('09:00:00', '11:00:00', 5, [1], [3]);
        $this->insertSequence('09:00:00', '11:00:00', 5, [1], [4]);
        $this->insertSequence('09:00:00', '10:00:00', 10, [1], [2]);
        $this->insertSequence('11:00:00', '18:20:00', 20, [1], [3,2,4]);
        $this->insertSequence('14:00:00', '15:00:00', 4, [2,3,4], [1]);
        $this->insertSequence('15:00:00', '16:00:00', 7, [3,4], [1]);
        $this->insertSequence('15:00:00', '16:00:00', 7, [1], [4,2]);
        $this->insertSequence('18:00:00', '20:00:00', 3, [2,3,4], [1]);
    }

    public function insertSequence($start, $end, $minutes, array $origins, array $destinations){
        foreach ($origins as $origin) {
            $sequence = factory(App\Domain\SequenceElevatorRequest::class)->create([
                'start' => $start,
                'end' => $end,
                'seconds_interval' => $minutes*60,
                'origin_floor_id' => $origin,
                'destination_floor_id' => $destinations[0],
            ]);
            $this->insertDestination($sequence, $destinations);
        }

    }

    public function insertDestination(SequenceElevatorRequest $sequence, $floorIds){
        foreach ($floorIds as $floorId){
            DB::table('sequences_destination_floors')->insert([
                'sequence_id' => $sequence->id,
                'floor_id' => $floorId,
            ]);
        }
    }
}
