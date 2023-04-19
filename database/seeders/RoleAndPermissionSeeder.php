<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

use App\Repositories\SpatieRolesPermissions\PermissionModuleRepository;
use App\Repositories\SpatieRolesPermissions\RoleRepository;
use App\Repositories\SpatieRolesPermissions\PermissionRepository;

class RoleAndPermissionSeeder extends Seeder
{
    use InteractsWithIO;

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

        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** #Creando Módulos del Sistema# */
        $permissionModulesArray = config('permission.default-data.permission_modules');

        $this->info('Creando los módulos de la aplicación');

        $this->command->getOutput()->progressStart(count($permissionModulesArray));

        foreach ($permissionModulesArray as $permissionModuleItem) {
            sleep(1);
            $this->info("\n-Creando el módulo de permiso: '{$permissionModuleItem['title']}'\n");
            $this->permissionModuleRepository->create($permissionModuleItem);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();

        /** #Creando Roles del Sistema */
        $rolesArray = config('permission.default-data.roles');

        $this->info('Creando los roles predeterminados de la aplicación');

        $this->command->getOutput()->progressStart(count($rolesArray));

        /** @var \App\Models\SpatieRolesPermissions\Role $superRole */
        $superRole = null;
        foreach ($rolesArray as $index => $roleItem) {
            sleep(1);

            $this->info("\n-Creando el rol: '{$roleItem['title']}'\n");
            $role = $this->roleRepository->create($roleItem);
            if ($index == 0) {
                $superRole = $role;
            }
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();

        /** #Creando Permisos del Sistema# */
        $permissionsArray = config('permission.default-data.permissions');

        $this->info('Creando los permisos disponibles de la aplicación');

        $this->command->getOutput()->progressStart(count($permissionsArray));

        $permissionCollection = collect();
        foreach ($permissionsArray as $permissionItem) {
            sleep(1);
            $this->info("\n-Creando el permiso: '{$permissionItem['title']}'\n");
            $permission = $this->permissionRepository->create($permissionItem);
            $permissionCollection->push($permission);
            $this->command->getOutput()->progressAdvance();
        }

        $superRole->syncPermissions($permissionCollection);
        $this->command->getOutput()->progressFinish();
    }
}
