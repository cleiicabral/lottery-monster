<?php

namespace App\Http\Dtos\LotteryTicket;

use Spatie\DataTransferObject\DataTransferObject;

class CreateLotteryTicketDto extends DataTransferObject
{

    public string $ticket_code;
    public string $lottery_player_id;
    public string $draw_code;
    public bool $is_winner;

    public function __construct(array $data)
    {
        $this->ticket_code = !empty($data['ticket_code']) ? $data['ticket_code'] : '';
        $this->lottery_player_id = !empty($data['lottery_player_id']) ? $data['lottery_player_id'] : '';
        $this->draw_code = !empty($data['draw_code']) ? $data['draw_code'] : '';
        $this->is_winner = !empty($data['is_winner']) ? $data['is_winner'] : false;
    }
}
