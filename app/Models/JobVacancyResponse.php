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


    public function User(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function JobVacancy(): HasOne
    {
        return $this->hasOne(JobVacancy::class, 'id', 'job_vacancy_id');
    }
}
