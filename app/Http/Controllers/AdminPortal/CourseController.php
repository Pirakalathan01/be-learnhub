<?php

namespace App\Http\Controllers\AdminPortal;

use App\Contracts\Services\AdminPortal\CourseServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPortal\Course\DeleteCourseRequest;
use App\Http\Requests\AdminPortal\Course\StoreCourseRequest;
use App\Http\Requests\AdminPortal\Course\UpdateCourseRequest;
use App\Http\Resources\AdminPortal\Course\CourseCollection;
use App\Http\Resources\AdminPortal\Course\CourseResource;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    private CourseServiceInterface $courseService;

    public function __construct(CourseServiceInterface $courseService)
    {
        $this->courseService = $courseService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): CourseCollection
    {
        $this->authorize('viewAny', Course::class);
        return new CourseCollection($this->courseService->paginate(
            $request->get('per_page', 15),
            [
                'id',
                'course_code',
                'course_name',
                'course_type',
                'course_fee',
                'description'
            ]
        ));
    }

    public function all(Request $request): CourseCollection
    {
        $this->authorize('viewAny', Course::class);
        return new CourseCollection($this->courseService->all(
            [
                'id',
                'course_code',
                'course_name',
                'course_type',
                'course_fee',
                'description'
            ]
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request): JsonResponse
    {
        $this->authorize('create', Course::class);
        return response()->json([
            'message' => 'Course created successfully',
            'Course' => new CourseResource($this->courseService->create($request->validated())),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $course): CourseResource
    {
        $course = $this->courseService->find($course);
        $this->authorize('view', $course);
        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, string $course): JsonResponse
    {
        $this->authorize('update',Course::class);
        $this->courseService->update($course, $request->validated());
        return response()->json([
            'message' => 'Course updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteCourseRequest $request, string $course): JsonResponse
    {
        $this->authorize('delete', $this->courseService->find($course));
        $this->courseService->delete($course);
        return response()->json([
            'message' => 'Course deleted successfully',
        ], 200);
    }
}
