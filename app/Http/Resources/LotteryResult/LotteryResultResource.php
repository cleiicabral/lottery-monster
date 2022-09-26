<?php

namespace App\Http\Resources\LotteryResult;

use Illuminate\Http\Resources\Json\JsonResource;

class LotteryResultResource extends JsonResource
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
            "name"=> $this['ticket']->lotteryPlayer->fullname,
            "yourNumbers" => $this['playerNumbers'] ?? null,
            "machineNumbers" => $this['machineNumbers'] ?? null,
            "winner" => boolval($this['ticket']->is_winner),
            "message" =>$this['drawn']->message
        ];
    }
}
