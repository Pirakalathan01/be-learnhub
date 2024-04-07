<?php



use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\StudentPortal\CourseController;
use App\Http\Controllers\StudentPortal\DashboardController;
use App\Http\Controllers\StudentPortal\EnrollmentController;
use App\Http\Controllers\StudentPortal\StudentController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::prefix('student')->group(function (Router $route) {

        //Dashboard
        $route->get('dashboard/overview-widget', [DashboardController::class, 'overviewWidget']);

        // Students
        $route->put('students/{student}', [StudentController::class, 'update']);
        $route->get('students/{student}', [StudentController::class, 'show']);

        // Courses
        $route->get('courses', [CourseController::class, 'index']);
        $route->get('courses/all', [CourseController::class, 'all']);
        $route->get('courses/{course}', [CourseController::class, 'show']);

        // Enrollments
        $route->post('enrollments', [EnrollmentController::class, 'store']);
        $route->get('enrollments', [EnrollmentController::class, 'index']);
        $route->get('enrollments/all', [EnrollmentController::class, 'all']);
        $route->get('enrollments/{enrollment}', [EnrollmentController::class, 'show']);


    });

});
