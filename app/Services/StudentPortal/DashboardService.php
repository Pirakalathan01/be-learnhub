<?php

namespace App\Services\StudentPortal;

use App\Contracts\Repositories\StudentPortal\EnrollmentRepositoryInterface;
use App\Contracts\Services\StudentPortal\DashboardServiceInterface;
use App\Enums\Status;

class DashboardService implements DashboardServiceInterface
{
    private EnrollmentRepositoryInterface $enrollmentRepository;

    public function __construct(EnrollmentRepositoryInterface $enrollmentRepository)
    {
        $this->enrollmentRepository = $enrollmentRepository;
    }

    public function overviewWidget(): array
    {
        return [
            [
                "label" => "Requested",
                "count" =>  $this->enrollmentRepository
                    ->findByAll('status', Status::Requested)
                    ->count(),
            ],
            [
                "label" => "Enrolled",
                "count" => $this->enrollmentRepository
                    ->findByAll('status', Status::Enrolled)
                    ->count(),
            ],
            [
                "label" => "Completed",
                "count" => $this->enrollmentRepository
                    ->findByAll('status', Status::Completed)
                    ->count(),
            ],
        ];
    }
}
