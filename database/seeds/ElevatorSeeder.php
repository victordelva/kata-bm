<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ElevatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Domain\Elevator::class, 3)->create();
    }
}
