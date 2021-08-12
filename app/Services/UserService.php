<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{

    protected $userRepository = null;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function isUserExist($email)
    {
        $users = $this->userRepository->getUser(['email' => $email]);

        return !$users->isEmpty();
    }

    public function registerUser($userInfo)
    {
        return $this->userRepository->createUser($userInfo);
    }
}
