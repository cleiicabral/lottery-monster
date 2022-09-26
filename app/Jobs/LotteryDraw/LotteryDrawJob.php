<?php

namespace App\Jobs\LotteryDraw;

use App\Http\Services\LotteryDraw\LotteryDrawService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LotteryDrawJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $drawIdentifier;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $drawIdentifier)
    {
        $this->drawIdentifier = $drawIdentifier;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(LotteryDrawService $service)
    {
        $service->execute($this->drawIdentifier);
    }
}
