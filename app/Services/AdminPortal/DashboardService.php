<?php

namespace App\Services\AdminPortal;

use App\Contracts\Repositories\AdminPortal\CourseRepositoryInterface;
use App\Contracts\Repositories\AdminPortal\EnrollmentRepositoryInterface;
use App\Contracts\Repositories\AdminPortal\StudentRepositoryInterface;
use App\Contracts\Services\AdminPortal\DashboardServiceInterface;

class DashboardService implements DashboardServiceInterface
{
    private StudentRepositoryInterface $studentRepository;
    private CourseRepositoryInterface $courseRepository;
    private EnrollmentRepositoryInterface $enrollmentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository, CourseRepositoryInterface $courseRepository, EnrollmentRepositoryInterface $enrollmentRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->courseRepository = $courseRepository;
        $this->enrollmentRepository = $enrollmentRepository;
    }

    public function overviewWidget(): array
    {
        return [
            [
                "label" => "Students",
                "count" => $this->studentRepository->all()->count(),
            ],
            [
                "label" => "Courses",
                "count" => $this->courseRepository->all()->count(),
            ],
            [
                "label" => "Enrollments",
                "count" => $this->enrollmentRepository->all()->count(),
            ],
        ];
    }
}
