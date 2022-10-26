<?php

namespace App\Services;

use App\Repositories\SectorRepository;

class SectorService extends BaseService implements SectorServiceInterface
{
    protected $defaultRelations = ['sector'];

    /**
     * Method __construct
     *
     * @param SectorRepository $repository [explicite description]
     *
     * @return void
     */
    public function __construct(SectorRepository $repository)
    {
        parent::__construct($repository);
    }

}
