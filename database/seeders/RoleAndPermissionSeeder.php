<?php

namespace Database\Seeders;

use App\Repositories\PermissionModuleRepository;
use Illuminate\Database\Seeder;

use App\Repositories\RoleRepository;
use App\Repositories\PermissionRepository;

class RoleAndPermissionSeeder extends Seeder
{
    /** @var RoleRepository */
    protected $roleRepository;

    /** @var PermissionModuleRepository */
    protected $permissionModuleRepository;

    /** @var PermissionRepository */
    protected $permissionRepository;

    public function __construct(
        RoleRepository $roleRepository,
        PermissionModuleRepository $permissionModuleRepository,
        PermissionRepository $permissionRepository
    ) {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
        $this->permissionModuleRepository = $permissionModuleRepository;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionModulesData = config('permission.default-data.permission_modules');

        foreach ($permissionModulesData as $permissionModuleItem) {
            $this->permissionModuleRepository->create($permissionModuleItem);
        }

        $permissionsData = config('permission.default-data.permissions');

        foreach ($permissionsData as $permissionItem) {
            $this->permissionRepository->create($permissionItem);
        }
    }
}
