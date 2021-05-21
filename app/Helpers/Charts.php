<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use DB;

class Charts
{
    public static function generate($table)
    {
        $newusers = [];
        $users = DB::table($table)->get();

        for ($i = 0; $i < 12; $i++) {
            $newusers[$i] = 0;
            foreach ($users as $user) {
                if (\Carbon\Carbon::parse($user->created_at)->format('Y') == \Carbon\Carbon::now()->format('Y') && \Carbon\Carbon::parse($user->created_at)->format('m') == $i+1) {
                    $newusers[$i] = $newusers[$i] + 1;
                }
            }
        }

        return $newusers;
    }
}
