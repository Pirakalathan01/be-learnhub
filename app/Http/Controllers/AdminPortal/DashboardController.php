<?php

namespace App\Http\Controllers\AdminPortal;

use App\Contracts\Services\AdminPortal\DashboardServiceInterface;
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
