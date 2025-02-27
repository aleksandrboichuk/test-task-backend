<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use danog\MadelineProto\Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->setModel($model);
    }

    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    public function find(int $id): Model|Collection|Builder|array|null
    {
        return $this->model->query()->find($id);
    }

    public function create(array $attributes): Model
    {
        $item = new $this->model;

        $item->fill($attributes);

        if(!$item->save()){
            throw new Exception("Creation error ({$this->model->getTable()})");
        }

        return $item;
    }

    public function update(int $id, array $attributes): bool
    {
        $item = $this->find($id);

        if(!$item){
            return false;
        }

        $item->fill($attributes);

        if(!$item->save()){
            throw new Exception("Update error ({$this->model->getTable()})");
        }

        return true;
    }
}