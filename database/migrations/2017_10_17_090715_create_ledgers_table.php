<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('when');
            $table->unsignedInteger('trip_id');
            $table->unsignedInteger('fromable_id');
            $table->string('fromable_type');
            $table->unsignedInteger('toable_id');
            $table->string('toable_type');
            $table->string('amount');
            $table->string('reason');
            $table->dateTime('approval')->nullable();
            $table->unsignedInteger('approved_by')->nullable();
            $table->unsignedInteger('created_by');
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
        Schema::dropIfExists('ledgers');
    }
}
