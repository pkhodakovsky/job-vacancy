<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_vacancy_likes', function (Blueprint $table) {
            $table->foreignUuid('user_id')->index()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('job_vacancy_id')->index()->constrained('job_vacancies')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_vacancy_likes');
    }
};
