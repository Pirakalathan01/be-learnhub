<?php

namespace App\Http\Controllers\AdminPortal;

use App\Contracts\Services\AdminPortal\AdminServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPortal\Admin\StoreAdminRequest;
use App\Http\Requests\AdminPortal\Admin\UpdateAdminRequest;
use App\Http\Resources\AdminPortal\Admin\AdminCollection;
use App\Http\Resources\AdminPortal\Admin\AdminResource;
use App\Models\Admin;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private AdminServiceInterface $adminService;

    public function __construct(AdminServiceInterface $adminService)
    {
        $this->adminService = $adminService;
    }
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(Request $request): AdminCollection
    {
        $this->authorize('viewAny', Admin::class);
        return new AdminCollection($this->adminService->paginate(
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

    public function all(Request $request): AdminCollection
    {
        $this->authorize('viewAny', Admin::class);
        return new AdminCollection($this->adminService->all(
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
     * Display the specified resource.
     */
    public function show(string $admin): AdminResource
    {
        $admin = $this->adminService->find($admin);
        $this->authorize('view', $admin);
        return new AdminResource($admin);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, string $admin): JsonResponse
    {
        $this->authorize('update',Admin::class);
        $this->adminService->update($admin, $request->validated());
        return response()->json([
            'message' => 'Admin updated successfully',
        ], 200);
    }

}
