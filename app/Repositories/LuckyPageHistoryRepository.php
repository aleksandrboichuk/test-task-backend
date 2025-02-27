<?php

namespace App\Repositories;

use App\Models\LuckyPageHistory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class LuckyPageHistoryRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new LuckyPageHistory);
    }

    public function retrieveLastEntries(string $hash, int $userId, int $count = 3): Collection
    {
        return $this->model->query()
            ->whereHas('page', fn($query) => $query->retrieveByHash($hash, $userId))
            ->select(['result', 'number', 'sum'])
            ->latest()
            ->limit($count)
            ->get();
    }
}