<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSequencesDestinationFloorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sequences_destination_floors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sequence_id');
            $table->unsignedBigInteger('floor_id');

            $table->foreign('floor_id')->references('id')->on('floors')->onDelete('cascade');
            $table->foreign('sequence_id')->references('id')->on('sequence_elevator_requests')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sequences_destination_floors');
    }
}
