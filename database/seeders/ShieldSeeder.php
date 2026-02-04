<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Định nghĩa các resources
        $resources = ['Role', 'User', 'Blog', 'Post', 'Page', 'Order', 'OrderItem', 'Collection', 'Product', 'Showcase'];

        // 2. Định nghĩa các actions
        $actions = ['View', 'ViewAny', 'Create', 'Update', 'Delete', 'Restore', 'ForceDelete', 'ForceDeleteAny', 'RestoreAny', 'Replicate', 'Reorder'];

        // 3. Tạo mảng permissions
        $permissions = [];
        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                $permissions[] = "{$action}:{$resource}";
            }
        }

        // 4. Tạo tất cả permissions một lần
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // 4. Tạo role và gán permission
        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => 'web',
        ]);

        $customerRole = Role::firstOrCreate([
            'name' => 'customer',
            'guard_name' => 'web',
        ]);

        // Super Admin có tất cả permissions
        $superAdminRole->syncPermissions($permissions);

        // 5. Tạo super admin user
        $user = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Admin@123'),
                'email_verified_at' => now(),
                'is_admin' => true, // nếu bạn có cột này trong users table
            ]
        );

        $user->assignRole('super_admin');

        $this->command->info('Shield Seeding Completed.');
    }
}
