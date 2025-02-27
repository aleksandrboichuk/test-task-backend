<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\RegisterInterface;
use App\Services\LuckyPageService;
use danog\MadelineProto\Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function __construct(
        protected RegisterInterface $registerService,
        protected LuckyPageService $luckyPageService,
    ){}

    public function index(): View|Application|Factory
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        try{

            $result = $this->registerService->register($request, true);

            if(!$result){
                return back()->withErrors([
                    'system' => "Registration failed",
                ]);
            }

            $luckyPage = $this->luckyPageService->generate();

            return redirect()->route('lucky-page', ['hash' => $luckyPage]);

        }catch (\Exception $exception){

            // logging

            return back()->withErrors([
                'system' => "Something went wrong, try again later. ({$exception->getMessage()})",
            ]);
        }
    }
}
