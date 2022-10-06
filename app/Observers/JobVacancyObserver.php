<?php

namespace App\Observers;

use App\Enums\Setting\SettingEnum;
use App\Exceptions\JobVacancyException;
use App\Helpers\Setting\SettingHelper;
use App\Models\JobVacancy;
use App\Models\UserCoin;
use Carbon\Carbon;
use function PHPUnit\Framework\throwException;
use Illuminate\Validation\ValidationException;

class JobVacancyObserver
{
    /**
     * Handle the JobVacancy "created" event.
     *
     * @param \App\Models\JobVacancy $jobVacancy
     * @return void
     */
    public function creating(JobVacancy $jobVacancy)
    {
        $userCoin = auth()->user()->coin;
        $job_cost = SettingHelper::app()->get(SettingEnum::JOB_VACANCY_COST);
        if ($userCoin->coin < $job_cost) {
            throw ValidationException::withMessages([
                trans('Your Coin Balance is :balance , Job Vacancy Costs :cost',
                    [
                        'balance' => $userCoin->coin,
                        'cost' => $job_cost,
                    ]),
            ]);
        }
        $jobCountLast24 = JobVacancy::where('user_id', auth()->id())->
        where("created_at", ">", Carbon::now()->subDay())->get()->count();
        if ($jobCountLast24 > 2) {
            throw ValidationException::withMessages([
                trans('Cannot post more than two job vacancies per 24 hours'),
            ]);
        }
        auth()->user()->coin()->update(['coin' => $userCoin->coin - $job_cost]);
    }

    public function created(JobVacancy $jobVacancy)
    {
        //
    }

    /**
     * Handle the JobVacancy "updated" event.
     *
     * @param \App\Models\JobVacancy $jobVacancy
     * @return void
     */
    public function updated(JobVacancy $jobVacancy)
    {
        //
    }

    /**
     * Handle the JobVacancy "deleted" event.
     *
     * @param \App\Models\JobVacancy $jobVacancy
     * @return void
     */
    public function deleted(JobVacancy $jobVacancy)
    {
        //
    }

    /**
     * Handle the JobVacancy "restored" event.
     *
     * @param \App\Models\JobVacancy $jobVacancy
     * @return void
     */
    public function restored(JobVacancy $jobVacancy)
    {
        //
    }

    /**
     * Handle the JobVacancy "force deleted" event.
     *
     * @param \App\Models\JobVacancy $jobVacancy
     * @return void
     */
    public function forceDeleted(JobVacancy $jobVacancy)
    {
        //
    }
}
