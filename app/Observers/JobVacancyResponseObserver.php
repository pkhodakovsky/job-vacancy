<?php

namespace App\Observers;

use App\Enums\Setting\SettingEnum;
use App\Events\NewResponseEvent;
use App\Helpers\Setting\SettingHelper;
use App\Models\JobVacancy;
use App\Models\JobVacancyResponse;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class JobVacancyResponseObserver
{
    /**
     * Handle the JobVacancyResponse "created" event.
     *
     * @param \App\Models\JobVacancyResponse $jobVacancyResponse
     *
     * @return void
     */
    public function creating(JobVacancyResponse $jobVacancyResponse)
    {
        if (!auth()->check()) {
            throw ValidationException::withMessages([
                trans(
                    'Login before sending response'
                ),
            ]);
        }
        $userCoin = auth()->user()->coin;

        $job_vacancy_response = SettingHelper::app()->get(
            SettingEnum::JOB_RESPONSE_COST
        );
        if ($userCoin->coin < $job_vacancy_response) {
            throw ValidationException::withMessages([
                trans(
                    'Your Coin Balance is :balance , Response to a Job Vacancy Costs :cost',
                    [
                        'balance' => $userCoin->coin,
                        'cost'    => $job_vacancy_response,
                    ]
                ),
            ]);
        }
        $jobVacancyResponsesCount = JobVacancyResponse::where(
            'user_id',
            auth()->id()
        )->where('job_vacancy_id', $jobVacancyResponse->job_vacancy_id)->get()
            ->count();
        if ($jobVacancyResponsesCount > 0) {
            throw ValidationException::withMessages([
                trans(
                    'Users cannot send more than one responses to the same job vacancy'
                ),
            ]);
        }
        auth()->user()->coin()->update(
            ['coin' => $userCoin->coin - $job_vacancy_response]
        );
    }

    public function created(JobVacancyResponse $jobVacancyResponse)
    {
        $response_counter = JobVacancyResponse::where(
            'id',
            $jobVacancyResponse->id
        )->where('created_at', '>=', Carbon::now()->addHours(-1))->count();
        if ($response_counter === 1) {
            NewResponseEvent::dispatch($jobVacancyResponse);
        }
    }

    /**
     * Handle the JobVacancyResponse "updated" event.
     *
     * @param \App\Models\JobVacancyResponse $jobVacancyResponse
     *
     * @return void
     */
    public function updated(JobVacancyResponse $jobVacancyResponse)
    {
        //
    }

    /**
     * Handle the JobVacancyResponse "deleted" event.
     *
     * @param \App\Models\JobVacancyResponse $jobVacancyResponse
     *
     * @return void
     */
    public function deleted(JobVacancyResponse $jobVacancyResponse)
    {
        //
    }

    /**
     * Handle the JobVacancyResponse "restored" event.
     *
     * @param \App\Models\JobVacancyResponse $jobVacancyResponse
     *
     * @return void
     */
    public function restored(JobVacancyResponse $jobVacancyResponse)
    {
        //
    }

    /**
     * Handle the JobVacancyResponse "force deleted" event.
     *
     * @param \App\Models\JobVacancyResponse $jobVacancyResponse
     *
     * @return void
     */
    public function forceDeleted(JobVacancyResponse $jobVacancyResponse)
    {
        //
    }
}
