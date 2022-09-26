<?php

namespace App\Http\Controllers\Api\LotteryTicket;

use App\Http\Controllers\Controller;
use App\Http\Resources\LotteryResult\LotteryResultResource;
use App\Http\Services\LotteryTicket\CheckLotteryResultService;
use Illuminate\Http\Request;

class CheckLotteryTicketResultController extends Controller
{
   public function checkResultLottery(Request $request, CheckLotteryResultService $service)
   {
      try {
        $resultService = $service->execute($request->ticketCode);

        return new LotteryResultResource($resultService);
      } catch (\Throwable $th) {

        return response()->json(["error" => $th->getMessage()], 400);

      }
   }
}
