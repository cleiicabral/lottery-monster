<?php

namespace App\Models;

use App\Models\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LotteryPlayerNumber extends Model
{
    use HasFactory, TraitUuid, SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'lottery_player_id',
        'lottery_ticket_id',
        'number_ticket'
    ];

}
