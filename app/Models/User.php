<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Uuids;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail

{
    use HasApiTokens, Uuids, Notifiable, SoftDeletes;

    public $incrementing = false;
    public $keyType = 'string';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable
        = [
            'name',
            'email',
            'password',
        ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden
        = [
            'password',
            'remember_token',
        ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts
        = [
            'email_verified_at' => 'datetime',
        ];

    public function Coin(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserCoin::class, 'user_id', 'id');
    }

    public function Job(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(JobVacancy::class, 'user_id', 'id');
    }

    public function Likes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserLike::class, 'user_id', 'id');
    }
}
