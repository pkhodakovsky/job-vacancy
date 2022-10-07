<?php

namespace App\Models;

use App\ModelFilters\JobVacancyFilter;
use App\Traits\Uuids;

use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class JobVacancy extends Model
{
    use SoftDeletes, Uuids, Filterable, JobVacancyFilter;


    protected $table = "job_vacancies";
    protected $fillable = ["user_id", "title", "job_no", "body"];
    protected $casts = ['created_at' => 'date:Y-m-d'];


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'job_vacancy_tags');
    }

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function setJobNoAttribute(): void
    {
        $this->attributes['job_no'] = rand(111111111, 999999999);
    }

    public function Like()
    {
        return $this->hasMany(JobVacancyLikes::class, 'job_vacancy_id', 'id');
    }

    public function Response(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            JobVacancyResponse::class,
            'job_vacancy_id',
            'id'
        );
    }
}
