<?php

namespace App\Services\Role;

use App\Contracts\Repositories\Role\RoleRepositoryInterface;
use App\Contracts\Services\Role\RoleServiceInterface;
use Spatie\Permission\Models\Role;

class RoleService implements RoleServiceInterface
{
    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function find(string $id): ?Role
    {
        return $this->roleRepository->find($id);
    }

    public function findBy(string $column, string $value): ?Role
    {
        return $this->roleRepository->findBy($column, $value);
    }
}
