<?php

namespace App\Http\Controllers\StudentPortal;

use App\Contracts\Services\StudentPortal\DashboardServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    private DashboardServiceInterface $dashboardService;

    public function __construct(DashboardServiceInterface $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function overviewWidget (): JsonResponse
    {
        return response()->json([
            'overviewWidget' => $this->dashboardService->overviewWidget(),
        ], 200);
    }

}
