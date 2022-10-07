<?php

namespace App\Listeners;

use App\Events\NewResponseEvent;
use App\Models\JobVacancyResponse;
use App\Notifications\SendResponseEmailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendResponseListener implements ShouldQueue
{
    public $email_data;

    public function __construct()
    {
        $email_data = [];
    }


    public function handle($event)
    {
        $job_vacancy = $event->job_vacancy->job;
        $this->email_data = [
            'who_sent' => $event->job_vacancy->user,
            'job_vacancy' => $job_vacancy,
            'date' => $event->job_vacancy->created_at,
            'job_response_count' => JobVacancyResponse::where('job_vacancy_id', $job_vacancy->id)->count(),

        ];
        $job_vacancy->user->notify(new SendResponseEmailNotification($this->email_data));
    }
}
