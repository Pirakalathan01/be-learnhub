<?php

namespace App\Repositories\StudentPortal;

use App\Contracts\Repositories\StudentPortal\EnrollmentRepositoryInterface;
use App\Models\Enrollment;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

/**
 *
 */
class EnrollmentRepository extends BaseRepository implements EnrollmentRepositoryInterface
{
    /**
     * @param Enrollment $model
     */
    public function __construct(Enrollment $model)
    {
        $this->setModel($model);
    }

    public function findByAll(string $column, string $value): mixed
    {
        return $this->model->where('user_id', auth()->user()->id)->where($column, $value);
    }

    /**
     * @return Builder
     */
    public function queryBuilder(): Builder
    {
        return $this->model->where('user_id', auth()->user()->id);
    }

}
