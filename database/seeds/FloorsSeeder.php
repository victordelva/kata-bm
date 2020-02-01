<?php

use App\Domain\Floor;
use Illuminate\Database\Seeder;

class FloorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Floor::class)->create([
            'name' => "Planta Baja"
        ]);
        factory(Floor::class)->create([
            'name' => "Planta 1"
        ]);
        factory(Floor::class)->create([
            'name' => "Planta 2"
        ]);
        factory(Floor::class)->create([
            'name' => "Planta 3"
        ]);
    }
}
