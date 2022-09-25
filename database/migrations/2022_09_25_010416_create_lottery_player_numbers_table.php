<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotteryPlayerNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lottery_player_numbers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('lottery_player_id');
            $table->uuid('lottery_ticket_id');
            $table->tinyInteger('number_ticket');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lottery_player_id')->references('id')->on('lottery_players');
            $table->foreign('lottery_ticket_id')->references('id')->on('lottery_tickets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lottery_player_numbers');
    }
}
