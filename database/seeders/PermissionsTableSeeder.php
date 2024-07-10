<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 21,
                'title' => 'interval_create',
            ],
            [
                'id'    => 22,
                'title' => 'interval_edit',
            ],
            [
                'id'    => 23,
                'title' => 'interval_show',
            ],
            [
                'id'    => 24,
                'title' => 'interval_delete',
            ],
            [
                'id'    => 25,
                'title' => 'interval_access',
            ],
            [
                'id'    => 26,
                'title' => 'package_create',
            ],
            [
                'id'    => 27,
                'title' => 'package_edit',
            ],
            [
                'id'    => 28,
                'title' => 'package_show',
            ],
            [
                'id'    => 29,
                'title' => 'package_delete',
            ],
            [
                'id'    => 30,
                'title' => 'package_access',
            ],
            [
                'id'    => 31,
                'title' => 'withdraw_create',
            ],
            [
                'id'    => 32,
                'title' => 'withdraw_edit',
            ],
            [
                'id'    => 33,
                'title' => 'withdraw_show',
            ],
            [
                'id'    => 34,
                'title' => 'withdraw_delete',
            ],
            [
                'id'    => 35,
                'title' => 'withdraw_access',
            ],
            [
                'id'    => 36,
                'title' => 'page_create',
            ],
            [
                'id'    => 37,
                'title' => 'page_edit',
            ],
            [
                'id'    => 38,
                'title' => 'page_show',
            ],
            [
                'id'    => 39,
                'title' => 'page_delete',
            ],
            [
                'id'    => 40,
                'title' => 'page_access',
            ],
            [
                'id'    => 41,
                'title' => 'credit_setting_create',
            ],
            [
                'id'    => 42,
                'title' => 'credit_setting_edit',
            ],
            [
                'id'    => 43,
                'title' => 'credit_setting_show',
            ],
            [
                'id'    => 44,
                'title' => 'credit_setting_delete',
            ],
            [
                'id'    => 45,
                'title' => 'credit_setting_access',
            ],
            [
                'id'    => 46,
                'title' => 'payment_method_create',
            ],
            [
                'id'    => 47,
                'title' => 'payment_method_edit',
            ],
            [
                'id'    => 48,
                'title' => 'payment_method_show',
            ],
            [
                'id'    => 49,
                'title' => 'payment_method_delete',
            ],
            [
                'id'    => 50,
                'title' => 'payment_method_access',
            ],
            [
                'id'    => 51,
                'title' => 'total_credit_create',
            ],
            [
                'id'    => 52,
                'title' => 'total_credit_edit',
            ],
            [
                'id'    => 53,
                'title' => 'total_credit_show',
            ],
            [
                'id'    => 54,
                'title' => 'total_credit_delete',
            ],
            [
                'id'    => 55,
                'title' => 'total_credit_access',
            ],
            [
                'id'    => 56,
                'title' => 'message_create',
            ],
            [
                'id'    => 57,
                'title' => 'message_edit',
            ],
            [
                'id'    => 58,
                'title' => 'message_show',
            ],
            [
                'id'    => 59,
                'title' => 'message_delete',
            ],
            [
                'id'    => 60,
                'title' => 'message_access',
            ],
            [
                'id'    => 61,
                'title' => 'inbox_create',
            ],
            [
                'id'    => 62,
                'title' => 'inbox_edit',
            ],
            [
                'id'    => 63,
                'title' => 'inbox_show',
            ],
            [
                'id'    => 64,
                'title' => 'inbox_delete',
            ],
            [
                'id'    => 65,
                'title' => 'inbox_access',
            ],
            [
                'id'    => 66,
                'title' => 'payment_setting_create',
            ],
            [
                'id'    => 67,
                'title' => 'payment_setting_edit',
            ],
            [
                'id'    => 68,
                'title' => 'payment_setting_show',
            ],
            [
                'id'    => 69,
                'title' => 'payment_setting_delete',
            ],
            [
                'id'    => 70,
                'title' => 'payment_setting_access',
            ],
            [
                'id'    => 71,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
