<?php

namespace App\Console\Commands;

use App\Enums\Setting\SettingEnum;
use App\Helpers\Setting\SettingHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class giveCoinPer24 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gift:coin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Every user gets new coins every 24 hours';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('user_coins')
            ->where('coin', '<', 5)
            ->update([
                'coin' => DB::raw('coin + '.SettingHelper::app()->get(SettingEnum::GIFT_COIN_AMOUNT)),
            ]);

        return Command::SUCCESS;
    }
}
