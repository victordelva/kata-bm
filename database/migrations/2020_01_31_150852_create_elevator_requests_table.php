<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElevatorRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elevator_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('from_floor_id');
            $table->string('to_floor_ids');
            $table->time('time');
            $table->unsignedBigInteger('elevator_id')->nullable();
            $table->unsignedBigInteger('floors_on_request')->nullable();
            $table->unsignedBigInteger('floors_on_movement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('elevator_requests');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
