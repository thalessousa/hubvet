<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService extends BaseService implements ProductServiceInterface
{
    protected $defaultRelations = ['sector'];

    /**
     * Method __construct
     *
     * @param ProductRepository $repository [explicite description]
     *
     * @return void
     */
    public function __construct(ProductRepository $repository)
    {
        parent::__construct($repository);
    }

}
