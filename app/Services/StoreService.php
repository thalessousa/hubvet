<?php

namespace App\Services;

use App\Repositories\StoreRepository;

class StoreService extends BaseService implements StoreServiceInterface
{
    protected $defaultRelations = [];

    /**
     * Method __construct
     *
     * @param StoreRepository $repository [explicite description]
     *
     * @return void
     */
    public function __construct(StoreRepository $repository)
    {
        parent::__construct($repository);
    }

}
