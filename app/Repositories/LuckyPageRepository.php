<?php

namespace App\Repositories;

use App\Models\LuckyPage;
use Illuminate\Database\Eloquent\Model;

class LuckyPageRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new LuckyPage);
    }

    public function findByHash(string $hash, int $userId): Model|null
    {
        return $this->model
            ->retrieveByHash($hash, $userId)
            ->first();
    }

    public function deactivate(string $hash, int $userId): bool
    {
        return $this->model->query()
            ->retrieveByHash($hash, $userId)
            ->update(['is_active' => false]);
    }
}