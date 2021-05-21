<?php

namespace App\Helpers;

use DB;
use Auth;

class PermissionCheck
{
    public static function check(array $input)
    {
        $permission = DB::table('permissions')->where('group', $input[0])->where('key', $input[1])->first();
        if ($permission == null) {
            return false;
        }

        $user_permissions = DB::table('role_permissions')->where('role_id', Auth::user()->role_id)->where('permission_id', $permission->id)->first();
        if ($user_permissions == null) {
            return false;
        }

        return true;
    }

    public static function checkmultiple(array $input)
    {
        $checked = [];

        for ($x = 0; $x <= count($input) - 1; $x++) {
            $permission = DB::table('permissions')->where('group', $input[$x][0])->where('key', $input[$x][1])->first();
            if ($permission == null) {
                array_push($checked, false);
                continue;
            }

            $user_permissions = DB::table('role_permissions')->where('role_id', Auth::user()->role_id)->where('permission_id', $permission->id)->first();
            if ($user_permissions == null) {
                array_push($checked, false);
                continue;
            }

            array_push($checked, true);
            continue;
        }

        return $checked;
    }

    public static function is_admin($roleid)
    {
        $role_permissions = DB::table('role_permissions')->where('role_id', $roleid)->where('permission_id', 7)->get();

        if ($role_permissions != null) {
            return true;
        }

        return false;
    }

    public static function getRole($roleid)
    {
        $roles = DB::table('roles')->where('id', $roleid)->first();
        return $roles;
    }
}
