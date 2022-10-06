<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{
    protected $table = "user_likes";
    protected $fillable = ["user_who_liked", "user_id"];
    public $timestamps = false;
}
