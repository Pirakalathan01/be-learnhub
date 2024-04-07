<?php

namespace App\Http\Controllers\AdminPortal;

use App\Contracts\Services\AdminPortal\StudentServiceInterface;
use App\Contracts\Services\Role\RoleServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPortal\Student\DeleteStudentRequest;
use App\Http\Requests\AdminPortal\Student\StoreStudentRequest;
use App\Http\Requests\AdminPortal\Student\UpdateStudentRequest;
use App\Http\Resources\AdminPortal\Student\StudentCollection;
use App\Http\Resources\AdminPortal\Student\StudentResource;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private StudentServiceInterface $studentService;
    private RoleServiceInterface $roleService;

    public function __construct(StudentServiceInterface $studentService, RoleServiceInterface $roleService)
    {
        $this->studentService = $studentService;
        $this->roleService = $roleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): StudentCollection
    {
        $this->authorize('viewAny', Student::class);
        return new StudentCollection($this->studentService->paginate(
            $request->get('per_page', 15),
            [
                'id',
                'title',
                'first_name',
                'last_name',
                'email',
                'gender',
                'phone_number',
                'is_active'
            ]
        ));
    }

    public function all(Request $request): StudentCollection
    {
        $this->authorize('viewAny', Student::class);
        return new StudentCollection($this->studentService->all(
            [
                'id',
                'title',
                'first_name',
                'last_name',
                'email',
                'gender',
                'phone_number',
                'is_active'
            ]
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request): JsonResponse
    {
        $this->authorize('create', Student::class);
        $student = $this->studentService->create($request->validated());
        $studentRole = $this->roleService->findBy('name', config('role.student'));
        $student->assignRole($studentRole);
        $student->markEmailAsVerified();

        return response()->json([
            'message' => 'Student created successfully',
            'Student' => new StudentResource($student),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $student): StudentResource
    {
        $student = $this->studentService->find($student);
        $this->authorize('view', $student);
        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, string $student): JsonResponse
    {
        $this->authorize('update',Student::class);
        $this->studentService->update($student, $request->validated());
        return response()->json([
            'message' => 'Student updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteStudentRequest $request, string $student): JsonResponse
    {
        $this->authorize('delete', $this->studentService->find($student));
        $this->studentService->delete($student);
        return response()->json([
            'message' => 'Student deleted successfully',
        ], 200);
    }
}
