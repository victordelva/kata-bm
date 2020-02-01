<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElevatorStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elevator_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('request_id');
            $table->foreign('request_id')->references('id')
                ->on('elevator_requests')->onDelete('cascade');

            $table->unsignedBigInteger('elevator_id');
            $table->foreign('elevator_id')->references('id')
                ->on('elevators')->onDelete('cascade');

            $table->unsignedBigInteger('floor_id');
            $table->foreign('floor_id')->references('id')
                ->on('floors')->onDelete('cascade');

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
        Schema::dropIfExists('elevator_statuses');
    }
}
