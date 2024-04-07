<?php

namespace App\Services\AdminPortal;

use App\Contracts\Repositories\AdminPortal\CourseRepositoryInterface;
use App\Contracts\Services\AdminPortal\CourseServiceInterface;
use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 *
 */
class CourseService implements CourseServiceInterface
{
    /**
     * @var CourseRepositoryInterface
     */
    private CourseRepositoryInterface $courseRepository;

    /**
     * @param CourseRepositoryInterface $courseRepository
     */
    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * @param array $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->courseRepository->all($columns);
    }

    /**
     * @param int $itemPerPage
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function paginate(int $itemPerPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->courseRepository->paginate($itemPerPage, $columns);
    }

    /**
     * @param array $data
     * @return Course
     */
    public function create(array $data): Course
    {
        return $this->courseRepository->create($data);
    }

    /**
     * @param string $id
     * @return Course|null
     */
    public function find(string $id): ?Course
    {
        return $this->courseRepository->find($id);
    }

    /**
     * @param string $column
     * @param string $value
     * @return Course|null
     */
    public function findBy(string $column, string $value): ?Course
    {
        return $this->courseRepository->findBy($column, $value);
    }

    /**
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool
    {
        return $this->courseRepository->update($id, $data);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->courseRepository->delete($id);
    }
}
