<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->createRolesAndPermissions();

        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super@sdoligao.test',
        ]);

        $superAdmin->assignRole('super_admin');

        $this->command?->info('Super admin created (super@sdoligao.test / password)');
    }

    protected function createRolesAndPermissions(): void
    {
        $permissions = [
            'ViewAny:User', 'View:User', 'Create:User', 'Update:User', 'Delete:User',
            'DeleteAny:User', 'Restore:User', 'RestoreAny:User', 'ForceDelete:User',
            'ForceDeleteAny:User', 'Replicate:User', 'Reorder:User',
            'ViewAny:Organization', 'View:Organization', 'Create:Organization',
            'Update:Organization', 'Delete:Organization', 'DeleteAny:Organization',
            'Restore:Organization', 'RestoreAny:Organization', 'ForceDelete:Organization',
            'ForceDeleteAny:Organization', 'Replicate:Organization', 'Reorder:Organization',
            'ViewAny:Role', 'View:Role', 'Create:Role', 'Update:Role', 'Delete:Role',
            'DeleteAny:Role', 'Restore:Role', 'RestoreAny:Role', 'ForceDelete:Role',
            'ForceDeleteAny:Role', 'Replicate:Role', 'Reorder:Role',
        ];

        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
    }
}
