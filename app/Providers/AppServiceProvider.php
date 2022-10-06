<?php

namespace App\Providers;

use App\Helpers\Setting\SettingHelper;
use App\Models\JobVacancy;
use App\Models\JobVacancyResponse;
use App\Observers\JobVacancyObserver;
use App\Observers\JobVacancyResponseObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SettingHelper::class, function () {
            return new SettingHelper();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        SettingHelper::app()->set();
        JobVacancy::observe(JobVacancyObserver::class);
        JobVacancyResponse::observe(JobVacancyResponseObserver::class);

    }
}
