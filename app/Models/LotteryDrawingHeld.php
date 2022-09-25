<?php

namespace App\Models;

use App\Models\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LotteryDrawingHeld extends Model
{
    use HasFactory, TraitUuid, SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'draw_identifier',
        'drawn_at',
    ];
}
