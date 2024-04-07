<?php

namespace App\Console\Commands;

use App\Models\RoleAndPermission\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class CreateStudentRoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'student:role:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create student role';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $role = Role::firstOrCreate([
                'name' => config('role.student'),
            ]
        );

        $role->revokePermissionTo(Permission::all());

        $permissions = Permission::where('model', 'Students')
            ->whereIn('name', [
                'students-viewany',
                'students-view',
                'students-create',
                'students-update',
                'students-delete',
            ])->get();
        $this->givePermissions($role, $permissions);

        $permissions = Permission::where('model', 'Courses')
            ->whereIn('name', [
                'courses-viewany',
                'courses-view',
            ])->get();
        $this->givePermissions($role, $permissions);

        $permissions = Permission::where('model', 'Enrollments')
            ->whereIn('name', [
                'enrollments-viewany',
                'enrollments-view',
                'enrollments-create',
                'enrollments-update',
                'enrollments-delete',
            ])->get();
        $this->givePermissions($role, $permissions);


        $this->info('Student role created successfully!');
    }

    private function givePermissions($role, $permissions)
    {
        foreach ($permissions as $permission)
        {
            $role->givePermissionTo($permission);
        }
    }

}
