<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService extends BaseService implements UserServiceInterface
{
    protected $defaultRelations = ['store'];

    /**
     * Method __construct
     *
     * @param UserRepository $repository [explicite description]
     *
     * @return void
     */
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

}
