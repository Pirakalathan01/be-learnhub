<?php

namespace App\Contracts\Services\StudentPortal;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 *
 */
interface StudentServiceInterface
{
    /**
     * @param array $data
     * @return User
     */
    public function create(array $data): User;

    /**
     * @param string $id
     * @return User|null
     */
    public function find(string $id): ?User;

    /**
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool;

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;

}
