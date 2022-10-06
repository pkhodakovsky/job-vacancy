<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancyLikes extends Model
{
    protected $table = "job_vacancy_likes";
    public $timestamps = false;
    protected $fillable = ["job_vacancy_id", "user_id"];
}
