<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobVacancyResponse extends Model
{
    use Uuids, SoftDeletes;

    protected $table = 'job_vacancy_responses';
    protected $fillable = ["user_id", "job_vacancy_id", "body"];


    public function User(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Job(
    ): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(JobVacancy::class, 'job_vacancy_id', 'id');
    }
}
