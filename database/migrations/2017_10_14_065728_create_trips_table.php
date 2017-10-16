<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('truck_id')->index();
            $table->dateTime('started_at')->nullable();
            $table->string('odometer_start')->nullable();
            $table->string('odometer_end')->nullable();
            $table->string('total_income')->default(0);
            $table->string('total_way_point_expense')->default(0);
            $table->string('total_trip_expense')->default(0);
            $table->string('total_income_received')->default(0);
            $table->string('pending_balance')->default(0);
            $table->dateTime('completed_at')->nullable();
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
        Schema::dropIfExists('trips');
    }
}
