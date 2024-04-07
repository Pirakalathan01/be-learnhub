<?php

namespace App\Services\StudentPortal;

use App\Contracts\Repositories\StudentPortal\EnrollmentRepositoryInterface;
use App\Contracts\Services\StudentPortal\EnrollmentServiceInterface;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 *
 */
class EnrollmentService implements EnrollmentServiceInterface
{
    /**
     * @var EnrollmentRepositoryInterface
     */
    private EnrollmentRepositoryInterface $enrollmentRepository;

    /**
     * @param EnrollmentRepositoryInterface $enrollmentRepository
     */
    public function __construct(EnrollmentRepositoryInterface $enrollmentRepository)
    {
        $this->enrollmentRepository = $enrollmentRepository;
    }

    /**
     * @param array $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->enrollmentRepository->all($columns);
    }

    /**
     * @param int $itemPerPage
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function paginate(int $itemPerPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->enrollmentRepository->paginate($itemPerPage, $columns);
    }

    /**
     * @param array $data
     * @return Enrollment
     */
    public function create(array $data): Enrollment
    {
        return $this->enrollmentRepository->create($data);
    }

    /**
     * @param string $id
     * @return Enrollment|null
     */
    public function find(string $id): ?Enrollment
    {
        return $this->enrollmentRepository->find($id);
    }
}
