<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class EditOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            /*
            0 - Market Load
            1 - JSM Load
            2 - Empty Run
             */
            $table->tinyInteger('type')->default(0);
            $table->string('pod_status')->nullable();
            $table->string('pending_balance')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
