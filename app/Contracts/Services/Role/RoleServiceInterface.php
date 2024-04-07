<?php

namespace App\Contracts\Services\Role;

use Spatie\Permission\Models\Role;

/**
 *
 */
interface RoleServiceInterface
{
    /**
     * @param string $id
     * @return Role|null
     */
    public function find(string $id): ?Role;

    /**
     * @param string $column
     * @param string $value
     * @return Role|null
     */
    public function findBy(string $column, string $value): ?Role;

}
