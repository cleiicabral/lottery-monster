<?php

namespace App\Http\Resources\LotteryTicket;

use Illuminate\Http\Resources\Json\JsonResource;

class LotteryTicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            "ticket_code" => $this->ticket_code
        ];
    }
}
