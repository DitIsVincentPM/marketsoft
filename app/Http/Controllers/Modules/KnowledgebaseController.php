<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Team;
use App\Models\ShoppingCart;
use App\Models\Database\Knowledgebase_Categorys;

class KnowledgebaseController
{

    public function Knowledgebase()
    {
        $categories = Knowledgebase_Categorys::get();
        $knowledgebases = DB::table('knowledgebase')->get();
        $featured_articles = DB::table('knowledgebase')->where('is_featured', 1)->get();
        

        return view('Knowledgebase.index', [
            'knowledgebases' => $knowledgebases,
            'categories' => $categories,
            'featured_articles' => $featured_articles,
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