<?php

namespace App\Repositories\AdminPortal;

use App\Contracts\Repositories\AdminPortal\CourseRepositoryInterface;
use App\Models\Course;
use App\Repositories\BaseRepository;

/**
 *
 */
class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    /**
     * @param Course $model
     */
    public function __construct(Course $model)
    {
        $this->setModel($model);
    }

}
