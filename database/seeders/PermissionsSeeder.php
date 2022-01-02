<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            'roles-list',
            // 'roles-create',
            // 'roles-edit',
            // 'roles-delete',

            'users-list',
            // 'users-create',
            // 'users-edit',
            // 'users-delete',

            'products-list',
            // 'products-create',
            // 'products-edit',
            // 'products-delete',

            'categories-list',
            // 'categories-create',
            // 'categories-edit',
            // 'categories-delete',

            'carts-list',
            // 'carts-create',
            // 'carts-edit',
            // 'carts-delete',

            'orders-list',
            // 'orders-create',
            // 'orders-edit',
            // 'orders-delete',

            'create',
            'edit',
            'delete',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }
    }
}
