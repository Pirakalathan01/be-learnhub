<?php

namespace App\Http\Controllers\StudentPortal;


use App\Contracts\Services\StudentPortal\CourseServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPortal\Course\StoreCourseRequest;
use App\Http\Requests\AdminPortal\Course\UpdateCourseRequest;
use App\Http\Resources\StudentPortal\Course\CourseCollection;
use App\Http\Resources\StudentPortal\Course\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

/**
 *
 */
class CourseController extends Controller
{
    /**
     * @var CourseServiceInterface
     */
    private CourseServiceInterface $courseService;

    /**
     * @param CourseServiceInterface $courseService
     */
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

    /**
     * @param Request $request
     * @return CourseCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
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
     * Display the specified resource.
     */
    public function show(string $course): CourseResource
    {
        $course = $this->courseService->find($course);
        $this->authorize('view', $course);
        return new CourseResource($course);
    }

}
