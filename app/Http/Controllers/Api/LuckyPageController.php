<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Services\LuckyPageService;
use Illuminate\Http\JsonResponse;
use Mockery\Exception;

class LuckyPageController extends Controller
{
    public function __construct(
        protected LuckyPageService $luckyPageService,
    )
    {}

    public function index(string $hash): JsonResponse
    {
        try{

            [$result, $sum, $number] = $this->luckyPageService->imFeelingLucky($hash);

            if(!$result){
                return Response::badRequest('Lucky page not found');
            }

            return Response::success(compact('result', 'sum', 'number'));

        }catch (Exception $exception){
            return Response::failed($exception->getMessage());
        }
    }

    public function history(string $hash)
    {
        try{

            $history = $this->luckyPageService->history($hash, 3);

            return Response::success(compact('history'));

        }catch (Exception $exception){
            return Response::failed($exception->getMessage());
        }
    }

    public function deactivate(string $hash)
    {
        try{

            $success = $this->luckyPageService->deactivate($hash);

            return Response::success(compact('success'));

        }catch (Exception $exception){
            return Response::failed($exception->getMessage());
        }
    }

    public function generateNewLink()
    {
        try{

            $hash = $this->luckyPageService->generate();

            $link = route('lucky-page', ['hash' => $hash]);

            return Response::success(compact('link'));

        }catch (Exception $exception){
            return Response::failed($exception->getMessage());
        }
    }
}
