<?php

namespace App\Http\Controllers;

use App\Services\LuckyPageService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class LuckyPageController extends Controller
{
    public function __construct(
        protected LuckyPageService $luckyPageService
    )
    {}

    public function index(string $hash): View|Application|Factory
    {
        $luckyPage = $this->luckyPageService->retrieve($hash);

        if(!$luckyPage){
            abort(404);
        }

        return view('lucky-page.index', compact('luckyPage'));
    }
}
