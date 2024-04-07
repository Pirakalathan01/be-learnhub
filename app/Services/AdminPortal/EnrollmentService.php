<?php

namespace App\Services\AdminPortal;

use App\Contracts\Repositories\AdminPortal\EnrollmentRepositoryInterface;
use App\Contracts\Services\AdminPortal\EnrollmentServiceInterface;
use App\Enums\Status;
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
        $data['status'] = Status::Requested;
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

    /**
     * @param string $column
     * @param string $value
     * @return Enrollment|null
     */
    public function findBy(string $column, string $value): ?Enrollment
    {
        return $this->enrollmentRepository->findBy($column, $value);
    }

    /**
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool
    {
        return $this->enrollmentRepository->update($id, $data);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->enrollmentRepository->delete($id);
    }
}
