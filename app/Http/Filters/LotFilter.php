<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class LotFilter extends AbstractFilter
{

    protected function getCallbacks(): array
    {
        return [
            'categories' => [$this, 'categories']
        ];
    }

    public function categories(Builder $builder, $values)
    {
        $builder->whereHas('categories', function (Builder $query) use ($values){
            $query->whereIn('slug', $values);
        });
    }
}
