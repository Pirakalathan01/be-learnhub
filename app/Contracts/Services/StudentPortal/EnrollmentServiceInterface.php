<?php

namespace App\Contracts\Services\StudentPortal;

use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 *
 */
interface EnrollmentServiceInterface
{
    /**
     * @param array $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection;

    /**
     * @param int $itemPerPage
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function paginate(int $itemPerPage = 15, array $columns = ['*']): LengthAwarePaginator;

    /**
     * @param array $data
     * @return Enrollment
     */
    public function create(array $data): Enrollment;

    /**
     * @param string $id
     * @return Enrollment|null
     */
    public function find(string $id): ?Enrollment;

}
