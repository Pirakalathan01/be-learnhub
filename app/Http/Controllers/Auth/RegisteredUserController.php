<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Services\Role\RoleServiceInterface;
use App\Contracts\Services\StudentPortal\StudentServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterStudentRequest;
use App\Http\Resources\Auth\StudentLimitedResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    private UserServiceInterface $userService;
    private RoleServiceInterface $roleService;

    public function __construct(UserServiceInterface $userService, RoleServiceInterface $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    /**
     * Handle an incoming registration request.
     *
     */
    public function store(RegisterStudentRequest $request): JsonResponse
    {

        $student = $this->userService->create($request->validated());
        $studentRole = $this->roleService->findBy('name', config('role.student'));
        $student->assignRole($studentRole);
        $student->markEmailAsVerified();
//        event(new Registered($student));

//        Auth::login($student);

        return response()->json([
            'message' => 'Student Registered successfully',
            'Student' => new StudentLimitedResource($student),
        ], 201);
    }
}
