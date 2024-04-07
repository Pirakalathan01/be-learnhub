<?php

namespace App\Repositories\User;

use App\Contracts\Repositories\User\UserRepositoryInterface;
use App\Models\User;
use App\Repositories\BaseRepository;

/**
 *
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->setModel($model);
    }

}
