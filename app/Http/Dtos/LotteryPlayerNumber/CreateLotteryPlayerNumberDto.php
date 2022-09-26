<?php

namespace App\Http\Dtos\LotteryPlayerNumber;

use Spatie\DataTransferObject\DataTransferObject;

class CreateLotteryPlayerNumberDto extends DataTransferObject
{
    public string $lottery_player_id;
    public string $lottery_ticket_id;
    public int $number_ticket;

    public function __construct(array $data)
    {
        $this->lottery_player_id = !empty($data['lottery_player_id']) ? $data['lottery_player_id'] : '';
        $this->lottery_ticket_id = !empty($data['lottery_ticket_id']) ? $data['lottery_ticket_id'] : '';
        $this->number_ticket = !empty($data['number_ticket']) ? $data['number_ticket'] : 0;
    }
}
