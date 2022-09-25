<?php
Schema::create('lottery_player_numbers_backup', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('lottery_player_id');
            $table->uuid('lottery_ticket_id');
            $table->tinyInteger('numbers_ticket');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lottery_player_id')->references('id')->on('lottery_players');
            $table->foreign('lottery_ticket_id')->references('id')->on('lottery_tickets');
});

Schema::create('lottery_players_backup', function (Blueprint $table) {
    $table->uuid('id');
    $table->string('fullname',255);
    $table->timestamps();
    $table->softDeletes();

});

Schema::create('lottery_tickets_backup', function (Blueprint $table) {
    $table->uuid('id');
    $table->string('ticket_code');
    $table->boolean('is_drawn');
    $table->timestamps();
    $table->softDeletes();
});

Schema::create('numbers_drawn_backup', function (Blueprint $table) {
    $table->uuid('id');
    $table->integer('number_drawn');
    $table->timestamps();
    $table->softDeletes();
});



