<?php

namespace App\Services\Models;

use App\Http\Resources\JobVacancyResource;
use App\ModelFilters\JobVacancyFilter;
use App\Models\JobVacancy;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class JobVacancyService
{
    use Filterable, JobVacancyFilter;

    public static function getAll()
    {
        return JobVacancy::filter()->get();
    }

    public static function show($id)
    {
        return new JobVacancyResource(JobVacancy::with(['user'])->find($id));
    }
}
