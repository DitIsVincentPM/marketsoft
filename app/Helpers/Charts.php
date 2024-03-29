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

    public static function generate_invoices()
    {
        $newusers = [];
        $users = DB::table('ca_invoices')->where('status', 2)->get();

        for ($i = 0; $i < 12; $i++) {
            $newusers[$i] = 0;
            foreach ($users as $user) {
                if (\Carbon\Carbon::parse($user->created_at)->format('Y') == \Carbon\Carbon::now()->format('Y') && \Carbon\Carbon::parse($user->created_at)->format('m') == $i+1) {
                    for ($f=0; $f < count(json_decode($user->products, true)['items']); $f++) {
                        $newusers[$i] = $newusers[$i] + json_decode($user->products, true)['items'][$f]['price'];
                    }
                }
            }
        }

        return $newusers;
    }
}
