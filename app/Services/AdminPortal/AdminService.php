<?php

namespace App\Services\AdminPortal;

use App\Contracts\Repositories\AdminPortal\AdminRepositoryInterface;
use App\Contracts\Services\AdminPortal\AdminServiceInterface;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

/**
 *
 */
class AdminService implements AdminServiceInterface
{
    /**
     * @var AdminRepositoryInterface
     */
    private AdminRepositoryInterface $adminRepository;

    /**
     * @param AdminRepositoryInterface $adminRepository
     */
    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * @param array $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->adminRepository->all($columns);
    }

    /**
     * @param int $itemPerPage
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function paginate(int $itemPerPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->adminRepository->paginate($itemPerPage, $columns);
    }

    /**
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->adminRepository->create($data);
    }

    /**
     * @param string $id
     * @return User|null
     */
    public function find(string $id): ?User
    {
        return $this->adminRepository->find($id);
    }

    /**
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool
    {
        if (isset($data['password'])) $data['password'] = Hash::make($data['password']);
        return $this->adminRepository->update($id, $data);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->adminRepository->delete($id);
    }
}
