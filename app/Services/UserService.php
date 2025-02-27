<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository,
    )
    {}

    public function create(array $attributes): Model|Builder
    {
        return $this->userRepository->create($attributes);
    }
}
