<?php

namespace App\Repositories;

use App\Http\Filters\LotFilter;
use App\Models\Lot;
use App\Repositories\Interfaces\LotRepositoryInterface;
use Illuminate\Pagination\Paginator;

class LotRepository extends Repository implements LotRepositoryInterface
{
    protected function getModel() : string
    {
        return Lot::class;
    }

    public function getAllWithFilterablePaginate(LotFilter $filter) :? Paginator
    {
        return $this->startCondition()->filter($filter)->select(['name', 'id', 'created_at', 'updated_at'])
            ->orderByDesc('created_at')->simplePaginate(config('app.pagination_size'), 10);
    }


}
