<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            // Configuraciones y usuarios
            'ver configuraciones',
            'ver usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',

            // Roles
            'ver roles',
            'crear roles',
            'editar roles',
            'eliminar roles',

            // Requisiciones
            'ver requisiciones',
            'crear requisiciones',
            'editar requisiciones',
            'eliminar requisiciones',
            'ver requisiciones por cuenta',

            // Empleados
            'ver empleados',
            'crear empleados',
            'editar empleados',
            'eliminar empleados',

            // Documentos
            'ver documentos',
            'crear documentos',
            'editar documentos',
            'eliminar documentos',

            // Vacaciones
            'ver vacaciones',
            'crear vacaciones',
            'editar vacaciones',
            'eliminar vacaciones',

            // Puestos
            'ver puestos',
            'crear puestos',
            'editar puestos',
            'eliminar puestos',

            // Departamentos
            'ver departamentos',
            'crear departamentos',
            'editar departamentos',
            'eliminar departamentos',

            // Capacitaciones
            'ver capacitaciones',
            'crear capacitaciones',
            'editar capacitaciones',
            'eliminar capacitaciones',

            // Asistencias
            'ver asistencias',
            'crear asistencias',
            'editar asistencias',
            'eliminar asistencias',

            // Actividades
            'ver actividades',
            'crear actividades',
            'editar actividades',
            'eliminar actividades',
        ];

        // Crear permisos si no existen
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Definición de roles y permisos asignados
        $roles = [
            'Administrador' => $permissions,
            'Subdirector' => [
                'ver configuraciones',
                'ver usuarios',
                'ver roles',
                'ver requisiciones',
                'crear requisiciones',
                'editar requisiciones',
                'eliminar requisiciones',
                'ver requisiciones por cuenta',
                'ver categorias',
                'crear categorias',
                'editar categorias',
                'eliminar categorias',
            ],
            'Empleado' => [
                'ver requisiciones',
                'ver requisiciones por cuenta',
                'ver productos',
                'ver proveedores',
            ],
            'Observador' => [
                'ver requisiciones',
                'ver productos',
            ],
        ];

        // Crear roles y asignar permisos
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);

            // Obtener permisos y sincronizarlos con el rol
            $permissionsToAssign = Permission::whereIn('name', $rolePermissions)->get();
            $role->syncPermissions($permissionsToAssign);
        }
    }
}
