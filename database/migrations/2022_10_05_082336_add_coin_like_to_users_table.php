<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
//            $table->unsignedTinyInteger('coin')->
//            default(config('job.'.\App\Enums\Setting\SettingEnum::NEW_USER_COIN))->
//            after('email');
//            $table->unsignedInteger('like')->default(0)->
//            after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('coin');
        });
    }
};
