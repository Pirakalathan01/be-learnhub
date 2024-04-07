<?php

namespace App\Services\User;

use App\Contracts\Repositories\User\UserRepositoryInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function paginate(int $itemPerPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->userRepository->paginate($itemPerPage, $columns);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }

    /**
     * @inheritDoc
     */
    public function find(string $id): ?User
    {
        return $this->userRepository->find($id);
    }

    public function findBy(string $column, string $value): ?User
    {
        return $this->userRepository->findBy($column, $value);
    }

    /**
     * @inheritDoc
     */
    public function update(string $id, array $data): bool
    {
        return $this->userRepository->update($id, $data);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $id): bool
    {
        return $this->userRepository->delete($id);
    }
}
