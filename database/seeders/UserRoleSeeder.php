<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_roles')->insert(
            [
                [
                    'name' => 'super-administrator',
                    'description' => 'Has full access to the system, including managing all users, system settings, and critical data. Can override any other roles and permissions.',
                    'abb' => 'superadmin'
                ],
                [
                    'name' => 'administrator',
                    'description' => 'Manages day-to-day operations, including user management, content updates, and configuration of system resources. Does not have access to critical system settings.',
                    'abb' => 'admin'
                ],
                [
                    'name' => 'moderator',
                    'description' => 'Responsible for overseeing user activity, moderating content, and ensuring compliance with system policies. Has limited administrative privileges.',
                    'abb' => 'mod'
                ],
                [
                    'name' => 'uploader',
                    'description' => 'Has the ability to upload content, such as documents or media, but lacks administrative or moderation privileges. Limited to resource management only.',
                    'abb' => 'upldr'
                ]
            ]
        );
    }
}
