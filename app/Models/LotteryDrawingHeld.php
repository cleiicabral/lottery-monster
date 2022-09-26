<?php

namespace App\Models;

use App\Models\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LotteryDrawingHeld extends Model
{
    use HasFactory, TraitUuid, SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = true;

    protected $table = 'lottery_drawing_held';

    protected $fillable = [
        'draw_identifier',
        'drawn_at',
        'is_drawn'
    ];

    public function numberDraw()
    {
        return $this->hasMany(NumberDrawn::class,'lottery_drawing_held_id');
    }
}
