<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('role_user')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('permission_role')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('roles')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('permissions')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('users')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Role Data
        \DB::table('roles')->insert([
            'name' => 'administrator',
            'display_name' => 'Administrator',
            'description' => 'Hak akses untuk administrator'
        ]);
        // End Role Data

        // Permission Data
        // Home
        \DB::table('permissions')->insert([
            [
                'name' => 'home-view',
                'display_name' => 'Home View',
                'description' => 'Hak akses untuk menu home'
            ],
        ]);
        // User Management
        \DB::table('permissions')->insert([
            [
                'name' => 'user-management-view',
                'display_name' => 'User Management View',
                'description' => 'Hak akses untuk menu user management'
            ],
        ]);
        // Disbursement
        \DB::table('permissions')->insert([
            [
                'name' => 'disbursement-view',
                'display_name' => 'Disbursement View',
                'description' => 'Hak akses untuk menu disbursement'
            ],
        ]);
        // Role
        \DB::table('permissions')->insert([
            [
                'name' => 'role-view-list-data',
                'display_name' => 'Role View List Data',
                'description' => 'Hak akses untuk melihat list data'
            ],
            [
                'name' => 'role-add-new-data',
                'display_name' => 'Role Add New Data',
                'description' => 'Hak akses untuk menambah data'
            ],
            [
                'name' => 'role-edit-data',
                'display_name' => 'Role Edit Data',
                'description' => 'Hak akses untuk mengubah data'
            ],
            [
                'name' => 'role-access-management',
                'display_name' => 'Role Access Management',
                'description' => 'Hak akses untuk mengatur access management user'
            ],
        ]);

        // Permission
        \DB::table('permissions')->insert([
            [
                'name' => 'permission-view-list-data',
                'display_name' => 'Permission View List Data',
                'description' => 'Hak akses untuk melihat list data'
            ],
            [
                'name' => 'permission-add-new-data',
                'display_name' => 'Permission Add New Data',
                'description' => 'Hak akses untuk menambah data'
            ],
            [
                'name' => 'permission-edit-data',
                'display_name' => 'Permission Edit Data',
                'description' => 'Hak akses untuk mengubah data'
            ],
        ]);

        // User
        \DB::table('permissions')->insert([
            [
                'name' => 'user-view-list-data',
                'display_name' => 'User View List Data',
                'description' => 'Hak akses untuk melihat list data'
            ],
            [
                'name' => 'user-add-new-data',
                'display_name' => 'User Add New Data',
                'description' => 'Hak akses untuk menambah data'
            ],
            [
                'name' => 'user-edit-data',
                'display_name' => 'User Edit Data',
                'description' => 'Hak akses untuk mengubah data'
            ],
            [
                'name' => 'user-destroy-data',
                'display_name' => 'User Destroy Data',
                'description' => 'Hak akses untuk mengubah data'
            ],
        ]);

        // Disbursement
        \DB::table('permissions')->insert([
            [
                'name' => 'disbursement-create',
                'display_name' => 'Disbursement Create',
                'description' => 'Hak akses membuat disbursement'
            ],
            [
                'name' => 'disbursement-check-status',
                'display_name' => 'Disbursement Check Status',
                'description' => 'Hak akses mengecek status disbursement'
            ],
            [
                'name' => 'disbursement-list',
                'display_name' => 'Disbursement List',
                'description' => 'Hak akses melihat list data disbursement'
            ],
        ]);
        // End Permission Data

        // User Data
        \DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => \bcrypt('secret')
        ]);
        // End User Data

        // Role user data
        \DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
            'user_type' => 'App\Models\User',
        ]);
        // End Role user data

        // Permission role data
        // Home
        \DB::table('permission_role')->insert([
            'permission_id' => 1,
            'role_id' => 1,
        ]);

        // User management
        \DB::table('permission_role')->insert([
            'permission_id' => 2,
            'role_id' => 1,
        ]);

        // Disbursement
        \DB::table('permission_role')->insert([
            'permission_id' => 3,
            'role_id' => 1,
        ]);

        // Role
        \DB::table('permission_role')->insert(
            [
                [
                    'permission_id' => 4,
                    'role_id' => 1,
                ],
                [
                    'permission_id' => 5,
                    'role_id' => 1,
                ],
                [
                    'permission_id' => 6,
                    'role_id' => 1,
                ],
                [
                    'permission_id' => 7,
                    'role_id' => 1,
                ],
            ]
        );

        // Permission
        \DB::table('permission_role')->insert(
            [
                [
                    'permission_id' => 8,
                    'role_id' => 1,
                ],
                [
                    'permission_id' => 9,
                    'role_id' => 1,
                ],
                [
                    'permission_id' => 10,
                    'role_id' => 1,
                ],
            ]
        );

        // User
        \DB::table('permission_role')->insert(
            [
                [
                    'permission_id' => 11,
                    'role_id' => 1,
                ],
                [
                    'permission_id' => 12,
                    'role_id' => 1,
                ],
                [
                    'permission_id' => 13,
                    'role_id' => 1,
                ],
                [
                    'permission_id' => 14,
                    'role_id' => 1,
                ],
            ]
        );

         // Disbursement
         \DB::table('permission_role')->insert(
            [
                [
                    'permission_id' => 15,
                    'role_id' => 1,
                ],
                [
                    'permission_id' => 16,
                    'role_id' => 1,
                ],
                [
                    'permission_id' => 17,
                    'role_id' => 1,
                ],
            ]
        );
        // End Permission role data
    }
}
