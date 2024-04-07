<?php

namespace App\Providers;

use App\Contracts\Repositories\AdminPortal\AdminRepositoryInterface;
use App\Contracts\Repositories\AdminPortal\CourseRepositoryInterface;
use App\Contracts\Repositories\AdminPortal\EnrollmentRepositoryInterface;
use App\Contracts\Repositories\AdminPortal\StudentRepositoryInterface;
use App\Contracts\Repositories\Role\RoleRepositoryInterface;
use App\Contracts\Repositories\User\UserRepositoryInterface;
use App\Contracts\Services\AdminPortal\AdminServiceInterface;
use App\Contracts\Services\AdminPortal\CourseServiceInterface;
use App\Contracts\Services\AdminPortal\DashboardServiceInterface;
use App\Contracts\Services\AdminPortal\EnrollmentServiceInterface;
use App\Contracts\Services\AdminPortal\StudentServiceInterface;
use App\Contracts\Services\Role\RoleServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Repositories\AdminPortal\AdminRepository;
use App\Repositories\AdminPortal\CourseRepository;
use App\Repositories\AdminPortal\EnrollmentRepository;
use App\Repositories\AdminPortal\StudentRepository;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Services\AdminPortal\AdminService;
use App\Services\AdminPortal\CourseService;
use App\Services\AdminPortal\DashboardService;
use App\Services\AdminPortal\EnrollmentService;
use App\Services\AdminPortal\StudentService;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(RoleServiceInterface::class, RoleService::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);

        $this->app->bind(AdminServiceInterface::class, AdminService::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(CourseServiceInterface::class, CourseService::class);
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->bind(EnrollmentServiceInterface::class, EnrollmentService::class);
        $this->app->bind(EnrollmentRepositoryInterface::class, EnrollmentRepository::class);
        $this->app->bind(StudentServiceInterface::class, StudentService::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(DashboardServiceInterface::class, DashboardService::class);

        $this->app->bind(\App\Contracts\Services\StudentPortal\StudentServiceInterface::class, \App\Services\StudentPortal\StudentService::class);
        $this->app->bind(\App\Contracts\Repositories\StudentPortal\StudentRepositoryInterface::class, \App\Repositories\StudentPortal\StudentRepository::class);
        $this->app->bind(\App\Contracts\Services\StudentPortal\CourseServiceInterface::class, \App\Services\StudentPortal\CourseService::class);
        $this->app->bind(\App\Contracts\Repositories\StudentPortal\CourseRepositoryInterface::class, \App\Repositories\StudentPortal\CourseRepository::class);
        $this->app->bind(\App\Contracts\Services\StudentPortal\EnrollmentServiceInterface::class, \App\Services\StudentPortal\EnrollmentService::class);
        $this->app->bind(\App\Contracts\Repositories\StudentPortal\EnrollmentRepositoryInterface::class, \App\Repositories\StudentPortal\EnrollmentRepository::class);
        $this->app->bind(\App\Contracts\Services\StudentPortal\DashboardServiceInterface::class, \App\Services\StudentPortal\DashboardService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
