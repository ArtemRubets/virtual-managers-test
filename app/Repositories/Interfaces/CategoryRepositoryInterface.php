<?php

namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

interface CategoryRepositoryInterface
{
    public function getCategoriesList() :? Collection;

    public function getAllWithPaginate() :? Paginator;
}
