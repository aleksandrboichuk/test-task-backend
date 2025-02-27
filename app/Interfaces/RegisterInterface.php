<?php

namespace App\Interfaces;

use App\Http\Requests\RegisterRequest;

interface RegisterInterface
{
    public function register(RegisterRequest $request, bool $login = false): bool;
}
