<?php

namespace App\Repositories\NumberDrawn;

use App\Http\Dtos\NumberDraw\CreateNumberDrawDto;
use App\Models\NumberDrawn;
use App\Repositories\Interfaces\NumberDrawn\NumberDrawnRepositoryInterface;

class NumberDrawnRepository implements NumberDrawnRepositoryInterface
{
    private NumberDrawn $model;

    public function __construct(NumberDrawn $model)
    {
        $this->model = $model;
    }

    public function create(CreateNumberDrawDto $numberDrawDto): ?NumberDrawn
    {
        try {
            $resultCreateModel = $this->model::create($numberDrawDto->toArray());

            return $resultCreateModel;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
