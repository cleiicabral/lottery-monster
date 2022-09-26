<?php

namespace App\Repositories\Interfaces\NumberDrawn;

use App\Models\NumberDrawn;

interface NumberDrawnRepositoryInterface
{
    public function create(string $lotteryDrawingHeldId, int $numberDraw): ?NumberDrawn;
}
