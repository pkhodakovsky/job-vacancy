<?php

namespace App\Services;

use App\Models\JobVacancyLikes;
use App\Models\UserLike;

class CheckJobVacancyLikeService
{
    public static function init($jobVacancy)
    {
        $job_user_like_count = JobVacancyLikes::where('user_id', auth()->id())
            ->where('job_vacancy_id', $jobVacancy)->count();
        return $job_user_like_count===0;

    }
}
