<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobVacancy extends Model
{
    use SoftDeletes, Uuids;

    protected $table = "job_vacancies";
    protected $fillable = ["user_id", "like", "title","job_id","body"];

    public function User(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function setJobIdAttribute(): void
    {

        $this->attributes['job_id'] = rand(111111111, 999999999);
    }
}
