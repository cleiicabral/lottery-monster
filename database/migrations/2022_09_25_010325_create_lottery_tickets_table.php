<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotteryTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lottery_tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('lottery_player_id');
            $table->string('ticket_code');
            $table->string('draw_code');
            $table->boolean('is_winner')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lottery_player_id')->references('id')->on('lottery_players');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lottery_tickets');
    }
}
