<?php

namespace app\Services\Auth;

use App\Http\Requests\RegisterRequest;
use App\Interfaces\RegisterInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class RegisterService implements RegisterInterface
{

    public function __construct(
        protected UserRepository $userRepository
    ){}

    public function register(RegisterRequest $request, bool $login = false): bool
    {
        if(!$user = $this->userRepository->create($request->validated())){
            return false;
        }

        if ($login && Auth::loginUsingId($user->id)) {
            $request->session()->regenerate();
        }

        return true;
    }
}
