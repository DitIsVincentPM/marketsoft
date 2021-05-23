<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Team;
use App\Helpers\ShoppingCart;
use App\Models\Knowledgebase_Categories;

class KnowledgebaseController
{

    public function Knowledgebase()
    {
        $categories = Knowledgebase_Categories::get();
        $articles = DB::table('knowledgebase')->orderBy('views', 'desc')->paginate(5);        

        return view('Knowledgebase.index', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }

    public function KnowledgebaseCategory(Request $request, $id)
    {
        $category = DB::table('knowledgebase_categorys')->where('id', $id)->first();
        $articles = DB::table('knowledgebase')->orderBy('views', 'desc')->where('category_id', $id)->get();

        return view('Knowledgebase.category', [
            'articles' => $articles,
            'category' => $category,
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