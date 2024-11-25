<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Rezyon\Users\Enums\Types;
use Rezyon\Users\Models\Users;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $adminPermissions = [];
        $supplierPermissions = [];
        $tourismPermissions = [];
        $companyPermissions = [];

        foreach (config('permissions') as $root => $group) {
            if (!empty($group['admin'])) {
                foreach ($group['admin'] as $item) {
                    $adminPermissions[] = $item;
                }
            }
            if (!empty($group['supplier'])) {
                foreach ($group['supplier'] as $item) {
                    $supplierPermissions[] = $item;
                }
            }
            if (!empty($group['tourism_company'])) {
                foreach ($group['tourism_company'] as $item) {
                    $tourismPermissions[] = $item;
                }
            }
            if (!empty($group['companies'])) {
                foreach ($group['companies'] as $item) {
                    $companyPermissions[] = $item;
                }
            }
        }

        foreach ($adminPermissions as $permission) {
            Permission::query()->updateOrCreate(['name' => $permission]);
        }
        foreach ($supplierPermissions as $permission) {
            Permission::query()->updateOrCreate(['name' => $permission, 'guard_name' => 'companies']);
        }
        foreach ($tourismPermissions as $permission) {
            Permission::query()->updateOrCreate(['name' => $permission, 'guard_name' => 'companies']);
        }
        foreach ($companyPermissions as $permission) {
            Permission::query()->updateOrCreate(['name' => $permission, 'guard_name' => 'companies']);
        }

        $user = Users::query()->updateOrCreate([
            'email' => 'super-admin@kaat.digital'
        ],
            [
                'firstname' => 'Super',
                'lastname' => 'Admin',
                'password' => Hash::make('superpassword'),
                'type' => Types::ADMIN
            ]);
        $user->givePermissionTo($adminPermissions);

    }
}
