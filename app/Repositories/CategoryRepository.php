<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

class CategoryRepository extends Repository implements CategoryRepositoryInterface
{
    protected function getModel() : string
    {
        return Category::class;
    }

    public function getCategoriesList() :? Collection
    {
        return $this->startCondition()->all(['id', 'name', 'slug']);
    }

    public function getAllWithPaginate() :? Paginator
    {
        return $this->startCondition()->select()
            ->orderByDesc('created_at')->simplePaginate(config('app.pagination_size'), 10);
    }

}
