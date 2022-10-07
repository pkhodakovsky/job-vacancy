<?php

namespace App\Services\Models;

use App\Http\Resources\JobVacancyResource;
use App\ModelFilters\JobVacancyFilter;
use App\Models\JobVacancy;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

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

    public static function create($jobVacancy)
    {
        try {
            return JobVacancy::create($jobVacancy);
        } catch (ValidationException  $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }

    public static function update($jobVacancyData, $id)
    {
        try {
            $jobVacancy = JobVacancy::findOrFail($id);
            if ($jobVacancy->user_id !== auth()->id()) {
                return response()->json(
                    [
                        'message' => trans(
                            'Only owners can update their job vacancies'
                        )
                    ],
                    410
                );
            }
            return $jobVacancy->update($jobVacancyData);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ['message' => trans('Job Vacancy Not Found')],
                404
            );
        }
    }
}
