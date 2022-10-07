<?php

namespace App\ModelFilters;

use App\Models\JobVacancy;
use Illuminate\Database\Eloquent\Builder;

trait JobVacancyFilter
{
    /**
     * This is a sample custom query
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param                                       $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    private static $whiteListFilter = [
        'response_count',
        'created_at',
    ];

    public function response_count(Builder $builder, $value)
    {
        return $builder->has('response', '=', $value);

    }
}
