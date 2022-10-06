<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class JobVacancy extends Model
{
    use SoftDeletes, Uuids;

    protected $table = "job_vacancies";
    protected $fillable = ["user_id", "title", "job_no", "body"];
    protected $casts = ['created_at' => 'date:Y-m-d'];


    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function setJobNoAttribute(): void
    {
        $this->attributes['job_no'] = rand(111111111, 999999999);
    }


    public function JobVacancyResponses(
    ): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            JobVacancyResponse::class,
            'job_vacancy_id',
            'id'
        );
    }
}
