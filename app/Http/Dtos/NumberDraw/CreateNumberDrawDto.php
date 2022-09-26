<?php

namespace App\Http\Dtos\NumberDraw;

use Spatie\DataTransferObject\DataTransferObject;

class CreateNumberDrawDto extends DataTransferObject
{

    public string $lottery_drawing_held_id;
    public int $number_drawn;

    public function __construct(array $data)
    {
        $this->lottery_drawing_held_id = !empty($data['lottery_drawing_held_id']) ? $data['lottery_drawing_held_id'] : '';
        $this->number_drawn = !empty($data['number_drawn']) ? $data['number_drawn'] : 0;
    }
}
