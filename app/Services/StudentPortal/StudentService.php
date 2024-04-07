<?php

namespace App\Services\StudentPortal;

use App\Contracts\Repositories\StudentPortal\StudentRepositoryInterface;
use App\Contracts\Services\StudentPortal\StudentServiceInterface;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class StudentService implements StudentServiceInterface
{
    private StudentRepositoryInterface $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function create(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->studentRepository->create($data);
    }

    public function find(string $id): ?User
    {
        return $this->studentRepository->find($id);
    }

    public function update(string $id, array $data): bool
    {
        return $this->studentRepository->update($id, $data);
    }

    public function delete(string $id): bool
    {
        return $this->studentRepository->delete($id);
    }
}
