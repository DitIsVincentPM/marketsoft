<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Knowledgebase;
use App\Models\Knowledgebase_Categories;
use Mail;
use Auth;

class KnowledgebaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
        $knowledgebase = Knowledgebase::get();
        $categorys = Knowledgebase_Categories::get();

        return view('Admin.knowledgebase', [
            'knowledgebases' => $knowledgebase,
            'categorys' => $categorys
        ]);
    }

    public function new(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $category_id = $request->input('category');

        Knowledgebase::insert([
            'name' => $name,
            'description' => $description,
            'category_id' => $category_id,
        ]);

        return redirect()->route('admin.knowledgebase')->with('success', "You have successfully created a new knowledgebase article!");
    }

    public function delete(Request $request, $id)
    {
        Knowledgebase::where('id', $id)->delete();

        return redirect()->route('admin.knowledgebase')->with('success', "You have successfully deleted the knowledgebase article #$id!");
    }

    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $category_id = $request->input('category');

        Knowledgebase::where('id', $id)->update([
            'name' => $name,
            'description' => $description,
            'category_id' => $category_id,
        ]);

        return redirect()->route('admin.knowledgebase')->with('success', "You have successfully edited knowledgebase article #$id!");
    }

    public function categorynew(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        Knowledgebase_Categories::insert([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('admin.knowledgebase')->with('success', "You have successfully created a new category!");
    }

    public function categorydelete(Request $request, $id)
    {
        Knowledgebase_Categories::where('id', $id)->delete();

        return redirect()->route('admin.knowledgebase')->with('success', "You have successfully deleted the category #$id!");
    }

    public function categoryupdate(Request $request, $id)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        Knowledgebase_Categories::where('id', $id)->update([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('admin.knowledgebase')->with('success', "You have successfully edited category #$id!");
    }
}
