<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Contracts\RepositoryInterface;

class BaseService implements BaseServiceInterface
{
    protected $repository;
    protected $cacheTime;
    protected $defaultRelations = [];

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(): Collection
    {
        return Cache::tags()->remember(
            'all',
            '60',
            fn () => $this->repository->with($this->defaultRelations)->all()
        );
    }
    public function paginate(array $data): Paginator
    {
        return Cache::tags()->remember(
                Arr::query(request()->query()),
                '60',
                fn () => $this->repository->with($this->defaultRelations)
                    ->paginate($data['limit'] ?? null, $data['columns'] ?? ['*'])
            );
    }

    public function delete(Model $model): void
    {
        $this->repository->delete($model->id);
    }

    public function store(array $data): Model
    {
        $model = $this->repository->create($data);
        return $this->find($model);
    }

    public function find(Model $model): Model
    {
        return Cache::tags()->remember(
            $model->id,
            '60',
            fn () => $this->repository->with($this->defaultRelations)->find($model->id)
        );    }

    public function update(array $data, Model $model): Model
    {
        $model = $this->repository->update($data, $model->id);
        return $this->find($model);
    }

}
