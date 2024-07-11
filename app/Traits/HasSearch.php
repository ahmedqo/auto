<?php

namespace App\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Exception;

trait HasSearch
{
    public function scopeSearch(Builder $builder, string $term = '')
    {
        if (!$this->searchable) {
            throw new Exception("Please define the searchable property . ");
        }

        $builder->where(function ($query) use ($term) {
            foreach ($this->searchable as $searchable) {
                if (Str::contains($searchable, '.')) {
                    $relation = Str::beforeLast($searchable, '.');
                    $column = Str::afterLast($searchable, '.');
                    $query->orWhereHas($relation, function ($subQuery) use ($column, $term) {
                        $subQuery->where($column, 'like', "%$term%");
                    });
                } else {
                    $query->orWhere($searchable, 'like', "%$term%");
                }
            }
        });

        return $builder;
    }
}
