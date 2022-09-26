<?php

namespace App\Repositories\Interfaces\LotteryPlayer;

use App\Models\LotteryPlayer;

interface LotteryPlayerRepositoryInterface
{
    public function create(string $fullname): ?LotteryPlayer;
}
