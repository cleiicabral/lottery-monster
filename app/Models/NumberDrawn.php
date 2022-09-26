<?php

namespace App\Models;

use App\Models\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NumberDrawn extends Model
{
    use HasFactory, TraitUuid, SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = true;

    protected $table = 'numbers_drawn';

    protected $fillable = [
        'lottery_drawing_held_id',
        'number_drawn',
    ];
}
