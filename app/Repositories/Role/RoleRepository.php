<?php

namespace App\Repositories\Role;

use App\Contracts\Repositories\Role\RoleRepositoryInterface;
use App\Models\RoleAndPermission\Role;
use App\Repositories\BaseRepository;

/**
 *
 */
class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    /**
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        $this->setModel($model);
    }

}
