<?php

namespace App\Models;

use App\Models\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LotteryTicket extends Model
{
    use HasFactory, TraitUuid, SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = true;

    protected $fillable = [
        'lottery_player_id',
        'ticket_code',
        'is_drawn',
    ];

    public function lotteryPlayerNumber()
    {
        return $this->hasMany(LotteryPlayerNumber::class,'lottery_ticket_id');
    }

    public function lotteryPlayer()
    {
        return $this->belongsTo(LotteryPlayer::class,'lottery_player_id');
    }
}
