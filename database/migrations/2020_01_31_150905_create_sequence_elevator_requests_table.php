<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSequenceElevatorRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sequence_elevator_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('start');
            $table->time('end');
            $table->integer('seconds_interval');
            $table->unsignedBigInteger('origin_floor_id');
            $table->unsignedBigInteger('destination_floor_id');
            $table->timestamps();

            $table->foreign('origin_floor_id')->references('id')->on('floors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sequence_elevator_requests');
    }
}
