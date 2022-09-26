<?php

namespace App\Http\Dtos\DrawingHeld;

use Spatie\DataTransferObject\DataTransferObject;

class CreateDrawingHeldDto extends DataTransferObject
{
    public string $draw_identifier;
    public string $draw_at;

    public function __construct(array $data)
    {
        $this->draw_identifier = !empty($data['draw_identifier']) ? $data['draw_identifier'] : '';
        $this->draw_at = !empty($data['draw_at']) ? $data['draw_at'] : 'null';
    }
}
