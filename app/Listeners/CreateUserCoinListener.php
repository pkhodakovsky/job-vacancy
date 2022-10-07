<?php

namespace App\Listeners;

use App\Events\Registered;
use App\Models\UserCoin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class CreateUserCoinListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function handle($event)
    {
        return UserCoin::firstOrCreate(["user_id" => $event->user->id]);
    }
}
