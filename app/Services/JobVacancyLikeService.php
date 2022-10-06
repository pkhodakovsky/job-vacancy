<?php

namespace App\Services;

use App\Models\JobVacancyLikes;
use App\Models\UserLike;

class JobVacancyLikeService
{
    public static function check($jobVacancy)
    {
        $job_user_like_count = JobVacancyLikes::where('user_id', auth()->id())
            ->where('job_vacancy_id', $jobVacancy)->count();
        return $job_user_like_count === 0;
    }

    public static function create($jobVacancy)
    {
        return JobVacancyLikes::create(
            ["job_vacancy_id" => $jobVacancy, "user_id" => auth()->id()]
        );
    }
}
