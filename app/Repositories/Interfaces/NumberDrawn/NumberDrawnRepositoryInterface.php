<?php

namespace App\Repositories\Interfaces\NumberDrawn;

use App\Http\Dtos\NumberDraw\CreateNumberDrawDto;
use App\Models\NumberDrawn;

interface NumberDrawnRepositoryInterface
{
    public function create(CreateNumberDrawDto $numberDrawDto): ?NumberDrawn;
}
