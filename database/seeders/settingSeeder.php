<?php

namespace Database\Seeders;

use App\Enums\Setting\SettingEnum;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class settingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert([
//            [
//                Setting::KEY => SettingEnum::APP_URL,
//                Setting::VALUE => config('app.'.SettingEnum::APP_URL),
//            ],
//            [
//                Setting::KEY => SettingEnum::APP_NAME,
//                Setting::VALUE => config('app.'.SettingEnum::APP_NAME),
//            ],
//            [
//                Setting::KEY => SettingEnum::APP_DEBUG,
//                Setting::VALUE => config('app.'.SettingEnum::APP_DEBUG),
//            ],
            [
                Setting::KEY => SettingEnum::COIN_LIMIT,
                Setting::VALUE => config('job.'.SettingEnum::COIN_LIMIT),
            ],
            [
                Setting::KEY => SettingEnum::NEW_USER_COIN,
                Setting::VALUE => config('job.'.SettingEnum::NEW_USER_COIN),
            ],
            [
                Setting::KEY => SettingEnum::VACANCY_RESPONSE_LIMIT,
                Setting::VALUE => config('job.'.SettingEnum::VACANCY_RESPONSE_LIMIT),
            ],
            [
                Setting::KEY => SettingEnum::GIFT_COIN_AMOUNT,
                Setting::VALUE => config('job.'.SettingEnum::GIFT_COIN_AMOUNT),
            ],
            [
                Setting::KEY => SettingEnum::JOB_RESPONSE_COST,
                Setting::VALUE => config('job.'.SettingEnum::JOB_RESPONSE_COST),
            ],
            [
                Setting::KEY => SettingEnum::JOB_VACANCY_COST,
                Setting::VALUE => config('job.'.SettingEnum::JOB_VACANCY_COST),
            ],

        ]);
    }
}
