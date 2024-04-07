<?php

namespace App\Services\AdminPortal;

use App\Contracts\Repositories\AdminPortal\StudentRepositoryInterface;
use App\Contracts\Services\AdminPortal\StudentServiceInterface;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

/**
 *
 */
class StudentService implements StudentServiceInterface
{
    /**
     * @var StudentRepositoryInterface
     */
    private StudentRepositoryInterface $studentRepository;

    /**
     * @param StudentRepositoryInterface $studentRepository
     */
    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * @param array $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->studentRepository->all($columns);
    }

    /**
     * @param int $itemPerPage
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function paginate(int $itemPerPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->studentRepository->paginate($itemPerPage, $columns);
    }

    /**
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->studentRepository->create($data);
    }

    /**
     * @param string $id
     * @return User|null
     */
    public function find(string $id): ?User
    {
        return $this->studentRepository->find($id);
    }

    /**
     * @param string $column
     * @param string $value
     * @return User|null
     */
    public function findBy(string $column, string $value): ?User
    {
        return $this->studentRepository->findBy($column, $value);
    }

    /**
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool
    {
        return $this->studentRepository->update($id, $data);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->studentRepository->delete($id);
    }
}
