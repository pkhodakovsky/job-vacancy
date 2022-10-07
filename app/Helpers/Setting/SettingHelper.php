<?php

namespace App\Helpers\Setting;

use App\Enums\Cache\Settings\SettingsCacheEnum;
use App\Enums\Setting\SettingEnum as SettingKeysEnum;
use App\Models\Setting;
use Config;
use Illuminate\Support\Facades\Cache;

class SettingHelper
{
    protected $settings;

    public function __construct()
    {
        $this->init();
    }

    protected function init()
    {
        if (Cache::has(SettingsCacheEnum::KEY)) {
            $this->settings = Cache::get(SettingsCacheEnum::KEY);
        } else {
            $this->settings = Setting::query()->get()->keyBy(Setting::KEY);
            Cache::put(
                SettingsCacheEnum::KEY,
                $this->settings,
                SettingsCacheEnum::TTL
            );
        }
    }

    public static function app()
    {
        return app(SettingHelper::class);
    }

    public static function clear(): void
    {
        Cache::forget(SettingsCacheEnum::KEY);
    }

    public function get(string $key, $only_value = true)
    {
        $setting = $this->settings->where(Setting::KEY, $key)->first();

        return $only_value ? $setting[Setting::VALUE] : $setting;
    }

    public function set()
    {
        config([
//            'app.name'                                       => $this->get(
//                SettingKeysEnum::APP_NAME
//            ),
//            'app.debug'                                      => $this->get(
//                SettingKeysEnum::APP_DEBUG
//            ),
//            'app.url'                                        => $this->get(
//                SettingKeysEnum::APP_URL
//            ),
            'job.' . SettingKeysEnum::NEW_USER_COIN          => $this->get(
                SettingKeysEnum::NEW_USER_COIN
            ),
            'job.' . SettingKeysEnum::COIN_LIMIT             => $this->get(
                SettingKeysEnum::COIN_LIMIT
            ),
            'job.' . SettingKeysEnum::VACANCY_RESPONSE_LIMIT => $this->get(
                SettingKeysEnum::VACANCY_RESPONSE_LIMIT
            ),
            'job.' . SettingKeysEnum::GIFT_COIN_AMOUNT       => $this->get(
                SettingKeysEnum::GIFT_COIN_AMOUNT
            ),
            'job.' . SettingKeysEnum::JOB_RESPONSE_COST      => $this->get(
                SettingKeysEnum::JOB_RESPONSE_COST
            ),
            'job.' . SettingKeysEnum::JOB_VACANCY_COST       => $this->get(
                SettingKeysEnum::JOB_VACANCY_COST
            ),

        ]);
    }
}
