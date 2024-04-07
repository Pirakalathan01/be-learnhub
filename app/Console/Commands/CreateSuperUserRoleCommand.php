<?php

namespace App\Console\Commands;

use App\Enums\Gender;
use App\Enums\Title;
use App\Models\RoleAndPermission\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class CreateSuperUserRoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'super:user:role:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $role = Role::firstOrCreate([
                'name' => config('role.admin'),
            ]
        );

        $role->revokePermissionTo(Permission::all());

        $permissions = Permission::all();

        $this->givePermissions($role, $permissions);

        $user = User::where('email', 'admin@gmail.com')->first();
        if (!$user) {
            $user = User::firstOrCreate([
                    'title' => Title::Mr,
                    'first_name' => 'Admin',
                    'last_name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'is_active' => true,
                    'gender' => Gender::Male,
                    'phone_number' => '0771236547',
                    'password' => Hash::make('12345678'),
                ]
            );
        }
        $user->markEmailAsVerified();

        $user->removeRole($role);
        $user->assignRole($role);

        $this->info('Super user role created successfully!');
    }

    private function givePermissions($role, $permissions)
    {
        foreach ($permissions as $permission)
        {
            $role->givePermissionTo($permission);
        }
    }
}
