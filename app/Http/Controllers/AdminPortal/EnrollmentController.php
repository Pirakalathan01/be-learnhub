<?php

namespace App\Http\Controllers\AdminPortal;

use App\Contracts\Services\AdminPortal\EnrollmentServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPortal\Enrollment\DeleteEnrollmentRequest;
use App\Http\Requests\AdminPortal\Enrollment\StoreEnrollmentRequest;
use App\Http\Requests\AdminPortal\Enrollment\UpdateEnrollmentRequest;
use App\Http\Resources\AdminPortal\Enrollment\EnrollmentCollection;
use App\Http\Resources\AdminPortal\Enrollment\EnrollmentResource;
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
                'course_id'
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

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnrollmentRequest $request, string $enrollment): JsonResponse
    {
        $this->authorize('update',Enrollment::class);
        $this->enrollmentService->update($enrollment, $request->validated());
        return response()->json([
            'message' => 'Enrollment updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteEnrollmentRequest $request, string $enrollment): JsonResponse
    {
        $this->authorize('delete', $this->enrollmentService->find($enrollment));
        $this->enrollmentService->delete($enrollment);
        return response()->json([
            'message' => 'Enrollment deleted successfully',
        ], 200);
    }
}
