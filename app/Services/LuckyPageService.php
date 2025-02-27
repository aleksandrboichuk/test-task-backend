<?php

namespace App\Services;

use App\Repositories\LuckyPageHistoryRepository;
use App\Repositories\LuckyPageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LuckyPageService
{
    public function __construct(
        protected LuckyPageRepository $luckyPageRepository,
        protected LuckyPageHistoryRepository $luckyPageHistoryRepository,
    )
    {}

    public function retrieve(string $hash): Model|null
    {
        return $this->luckyPageRepository->findByHash($hash, auth()->id());
    }

    public function imFeelingLucky(string $hash): array|null
    {
        $page = $this->retrieve($hash);

        if(!$page){
            return null;
        }

        $lucky_page_id = $page->id;

        $number = rand(1, 1000);

        $result = $number % 2 ? "Lose" : "Win";

        $sum = $number % 2 ? 0 : $this->calculateSum($number);

        $this->luckyPageHistoryRepository->create(
            compact('result', 'number', 'sum', 'lucky_page_id')
        );

        return [$result, $sum, $number];
    }

    public function calculateSum(int $number): float
    {
        $percentage = match (true) {
            $number > 900 => 0.7,
            $number > 600 => 0.5,
            $number > 300 => 0.3,
            default => 0.1
        };

        return round($number * $percentage, 2);
    }

    public function generate(): string
    {
        $daysExpire = config('lucky_page.days_expire', 7);

        $hash = $this->generateHash();

        $this->luckyPageRepository->create([
            'hash' => $hash,
            'user_id' => auth()->id(),
            'expire_at' => now()->addDays($daysExpire),
        ]);

        return $hash;
    }

    public function retrieveHistory(string $hash, int $entriesCount): Collection
    {
        return $this->luckyPageHistoryRepository->retrieveLastEntries($hash, auth()->id(), $entriesCount);
    }

    public function deactivate(string $hash): bool
    {
        return $this->luckyPageRepository->deactivate($hash, auth()->id());
    }

    protected function generateHash(): string
    {
        return md5(now()->format("Y-m-d H:i:s") . auth()->id());
    }
}
