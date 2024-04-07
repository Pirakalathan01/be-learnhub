<?php

namespace App\Http\Controllers\StudentPortal;


use App\Contracts\Services\StudentPortal\EnrollmentServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPortal\Enrollment\StoreEnrollmentRequest;
use App\Http\Requests\AdminPortal\Enrollment\UpdateEnrollmentRequest;
use App\Http\Resources\StudentPortal\Enrollment\EnrollmentCollection;
use App\Http\Resources\StudentPortal\Enrollment\EnrollmentResource;
use App\Models\Enrollment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    private EnrollmentServiceInterface $enrollmentService;

    public function __construct(EnrollmentServiceInterface $enrollmentService)
    {
        $this->enrollmentService = $enrollmentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): EnrollmentCollection
    {
        $this->authorize('viewAny', Enrollment::class);
        return new EnrollmentCollection($this->enrollmentService->paginate(
            $request->get('per_page', 15),
            [
                'id',
                'user_id',
                'course_id',
                'status'
            ]
        ));
    }

    public function all(Request $request): EnrollmentCollection
    {
        $this->authorize('viewAny', Enrollment::class);
        return new EnrollmentCollection($this->enrollmentService->all(
            [
                'id',
                'user_id',
                'course_id',
                'status'
            ]
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnrollmentRequest $request): JsonResponse
    {
        $this->authorize('create', Enrollment::class);
        return response()->json([
            'message' => 'Enrollment created successfully',
            'Enrollment' => new EnrollmentResource($this->enrollmentService->create($request->validated())),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $enrollment): EnrollmentResource
    {
        $enrollment = $this->enrollmentService->find($enrollment);
        $this->authorize('view', $enrollment);
        return new EnrollmentResource($enrollment);
    }

}
