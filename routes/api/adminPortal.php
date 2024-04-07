<?php


use App\Http\Controllers\AdminPortal\AdminController;
use App\Http\Controllers\AdminPortal\CourseController;
use App\Http\Controllers\AdminPortal\DashboardController;
use App\Http\Controllers\AdminPortal\EnrollmentController;
use App\Http\Controllers\AdminPortal\StudentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::prefix('admin')->group(function (Router $route) {
        //Dashboard
        $route->get('dashboard/overview-widget', [DashboardController::class, 'overviewWidget']);

        // Admins
        $route->get('admins/all', [AdminController::class, 'all']);
        $route->apiResource('admins', AdminController::class);

        // Students
        $route->get('students/all', [StudentController::class, 'all']);
        $route->apiResource('students', StudentController::class);

        // Courses
        $route->get('courses/all', [CourseController::class, 'all']);
        $route->apiResource('courses', CourseController::class);

        // Enrollments
        $route->get('enrollments/all', [EnrollmentController::class, 'all']);
        $route->apiResource('enrollments', EnrollmentController::class);

    });

});


