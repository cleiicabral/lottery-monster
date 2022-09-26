<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterNumbersDrawnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('numbers_drawn', function (Blueprint $table) {
            $table->uuid('lottery_drawing_held_id')->after('id');

            $table->foreign('lottery_drawing_held_id')->references('id')->on('lottery_drawing_held');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('numbers_drawn', function (Blueprint $table) {
            $table->dropForeign('lottery_drawing_held_id');
            $table->dropColumn('lottery_drawing_held_id');
        });
    }
}
