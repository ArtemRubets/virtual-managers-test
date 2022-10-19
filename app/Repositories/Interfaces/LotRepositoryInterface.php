<?php

namespace App\Repositories\Interfaces;


use App\Http\Filters\LotFilter;
use Illuminate\Pagination\Paginator;

interface LotRepositoryInterface
{
    public function getAllWithFilterablePaginate(LotFilter $filter) :? Paginator;
}
