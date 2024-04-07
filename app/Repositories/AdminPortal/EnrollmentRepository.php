<?php

namespace App\Repositories\AdminPortal;

use App\Contracts\Repositories\AdminPortal\EnrollmentRepositoryInterface;
use App\Models\Enrollment;
use App\Repositories\BaseRepository;

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

}
