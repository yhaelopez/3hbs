<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airline_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->string('code');
            $table->enum('type', ['PASSENGER', 'FREIGHT']);
            $table->unsignedBigInteger('departure_id')->nullable();
            $table->unsignedBigInteger('destination_id')->nullable();
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->timestamps();

            $table->foreign('departure_id')->references('id')->on('airports')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('destination_id')->references('id')->on('airports')->nullOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
