<?php

namespace App\Http\Controllers\StudentPortal;

use App\Contracts\Services\StudentPortal\StudentServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPortal\Student\StoreStudentRequest;
use App\Http\Requests\AdminPortal\Student\UpdateStudentRequest;
use App\Http\Resources\StudentPortal\Student\StudentCollection;
use App\Http\Resources\StudentPortal\Student\StudentResource;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private StudentServiceInterface $studentService;

    public function __construct(StudentServiceInterface $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $student): StudentResource
    {
        $student = $this->studentService->find($student);
        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, string $student): JsonResponse
    {

        return response()->json([
            'message' => 'Student updated successfully',
        ], 200);
    }

}
