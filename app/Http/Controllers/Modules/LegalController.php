<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Team;
use App\Models\ShoppingCart;
use App\Models\Database\Knowledgebase_Categorys;
use Settings;

class LegalController
{
    public function tos()
    {
        $settings = DB::table('settings')->first();
        $sections = DB::table('tos_sections')->latest()->get();

        if(Settings::key('TosStatus') == 0)
        {
            return redirect()->route('index');
        }

        return view('Legal.tos', [
            'sections' => $sections,
        ]);
    }

    public function privacy()
    {
        $settings = DB::table('settings')->first();
        $sections = DB::table('privacy_sections')->latest()->get();

        if(Settings::key('PrivacyStatus') == 0)
        {
            return redirect()->route('index');
        }

        return view('Legal.privacy', [
            'sections' => $sections,
        ]);
    }
}