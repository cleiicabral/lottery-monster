<?php

namespace App\Http\Controllers\Api\LotteryTicket;

use App\Http\Controllers\Controller;
use App\Http\Resources\LotteryTicket\LotteryTicketResource;
use App\Http\Services\LotteryTicket\CreateLotteryTicketService;
use Illuminate\Http\Request;

class CreateLotteryTicketController extends Controller
{
   public function createLotteryTicket(Request $request, CreateLotteryTicketService $service)
   {
      try {

        $resultService = $service->execute($request->name, $request->numbers);

        return new LotteryTicketResource($resultService);

      } catch (\Throwable $th) {

        return response()->json(["error" => $th->getMessage()], 400);

      }
   }
}
