<?php

namespace App\Services;

use App\Models\UserLike;

class UserLikeService
{
    public static function check($userId)
    {
        $user_like_count = UserLike::where('user_id', $userId)->where(
            'user_who_liked',
            auth()->id()
        )->count();

        return $user_like_count === 0;
    }

    public static function create($userId)
    {
        return UserLike::create(
            ["user_who_liked" => auth()->id(), "user_id" => $userId]
        );
    }
}
