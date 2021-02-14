<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Team;

class InfoController
{
    public function announcements()
    {
        $announcements = DB::table('announcements')->get();

        return view('Announcements.index', [
            'announcements' => $announcements,
        ]);
    }

    public function AnnounceView(Request $request, $id)
    {
        $announcement = DB::table('announcements')->where('id', $id)->first();

        DB::table('announcements')->where('id', $id)->update([
            'views' => $announcement->views + 1,
        ]);

        return view('Announcements.view', [
            'announcement' => $announcement,
        ]);
    }

    public function Knowledgebase()
    {
        $category = DB::table('knowledgebase_categorys')->get();
        $knowledgebase = DB::table('knowledgebase')->get();

        return view('Knowledgebase.index', [
            'knowledgebases' => $knowledgebase,
            'categorys' => $category,
        ]);
    }

    public function KnowledgebaseCategory(Request $request, $id)
    {
        $category = DB::table('knowledgebase_categorys')->get();
        $knowledgebase = DB::table('knowledgebase')->where('category_id', $id)->get();

        return view('Knowledgebase.category', [
            'knowledgebases' => $knowledgebase,
            'categorys' => $category,
        ]);
    }

    public function KnowledgeView(Request $request, $id)
    {
        $knowledgebase = DB::table('knowledgebase')->where('id', $id)->first();

        DB::table('knowledgebase')->where('id', $id)->update([
            'views' => $knowledgebase->views + 1,
        ]);

        return view('Knowledgebase.view', [
            'knowledgebase' => $knowledgebase,
        ]);
    }
}