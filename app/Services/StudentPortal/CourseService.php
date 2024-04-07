<?php

namespace App\Services\StudentPortal;

use App\Contracts\Repositories\StudentPortal\CourseRepositoryInterface;
use App\Contracts\Services\StudentPortal\CourseServiceInterface;
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
     * @param string $id
     * @return Course|null
     */
    public function find(string $id): ?Course
    {
        return $this->courseRepository->find($id);
    }
}
