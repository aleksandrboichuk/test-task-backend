<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{

    public function create(array $attributes):  Model;

    public function update(int $id, array $attributes): bool;
}
