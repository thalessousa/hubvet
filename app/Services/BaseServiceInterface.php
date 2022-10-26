<?php

namespace App\Services;

use App\Exceptions\UnauthorizedUserException;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseServiceInterface
{
    /**
     * @throws UnauthorizedUserException
     */
    public function paginate(array $data): Paginator;

    /**
     * @throws UnauthorizedUserException
     */
    public function index(): Collection;

    /**
     * @throws UnauthorizedUserException
     */
    public function find(Model $model): Model;

    /**
     * @throws UnauthorizedUserException
     */
    public function delete(Model $model): void;

    /**
     * @throws UnauthorizedUserException
     */
    public function store(array $data): Model;

    /**
     * @throws UnauthorizedUserException
     */
    public function update(array $data, Model $model): Model;

}
