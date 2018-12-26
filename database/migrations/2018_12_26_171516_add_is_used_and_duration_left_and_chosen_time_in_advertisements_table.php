<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsUsedAndDurationLeftAndChosenTimeInAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            //
            $table->integer('is_used')->nullable();
            $table->timestamp('duration_left')->nullable();
            $table->timestamp('chosen_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            //
            $table->dropColumn('is_used');
            $table->dropColumn('duration_left');
            $table->dropColumn('chosen_time');
        });
    }
}
