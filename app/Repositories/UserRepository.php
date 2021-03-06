<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    public function getUser($query)
    {
        return User::where($query)->get();
    }

    public function createUser($userInfo)
    {
        return User::create($userInfo);
    }
}
