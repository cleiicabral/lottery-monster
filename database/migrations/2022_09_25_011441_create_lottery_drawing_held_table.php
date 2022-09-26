<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotteryDrawingHeldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lottery_drawing_held', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('draw_identifier');
            $table->dateTime('drawn_at')->nullable();
            $table->boolean('is_drawn')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lottery_drawing_held');
    }
}
