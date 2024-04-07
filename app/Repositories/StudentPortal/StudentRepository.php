<?php

namespace App\Repositories\StudentPortal;

use App\Contracts\Repositories\StudentPortal\StudentRepositoryInterface;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function __construct(User $model)
    {
        $this->setModel($model);
    }

    public function queryBuilder(): Builder
    {
        return $this->model->query()->whereHas('roles', function ($query) {
            $query->where('name', config('role.student'));
        });
    }
}
