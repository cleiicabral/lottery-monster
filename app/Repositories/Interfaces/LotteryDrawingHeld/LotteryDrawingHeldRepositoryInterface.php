<?php

namespace App\Repositories\Interfaces\LotteryDrawingHeld;

use App\Models\LotteryDrawingHeld;

interface LotteryDrawingHeldRepositoryInterface
{
    public function create(string $drawIdentifier, ?string $draw_at=null): ?LotteryDrawingHeld;
    public function findById(string $lotteryDrawingHeldId): ?LotteryDrawingHeld;
    public function findByDrawIdentifier(string $drawIdentifier): ?LotteryDrawingHeld;
    public function updateDrawHeld(string $lotteryDrawingHeldId, bool $isDraw): ?LotteryDrawingHeld;
    public function indexLastDraw(): ?LotteryDrawingHeld;
}
