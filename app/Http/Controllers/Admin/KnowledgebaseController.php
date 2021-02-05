<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\InputCheck as InputCheck;
use DB;

class KnowledgebaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
        $knowledgebase = DB::table('knowledgebase')->get();

        return view('admin.knowledgebase', [
            'knowledgebases' => $knowledgebase,
        ]);
    }

    public function new(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        
        $error = InputCheck::check([$name, $description]);
        if($error != false) {
            return redirect()->route('admin.announcements')->with('error', $error);
        }

        DB::table('knowledgebase')->insert([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('admin.knowledgebase')->with('success', "You have successfully created a new knowledgebase article!");
    }

    public function delete(Request $request, $id)
    {
        DB::table('knowledgebase')->where('id', $id)->delete();

        return redirect()->route('admin.knowledgebase')->with('success', "You have successfully deleted the announcement #$id!");
    }

    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        $error = InputCheck::check([$name, $description]);
        if($error != false) {
            return redirect()->route('admin.knowledgebase')->with('error', $error);
        }

        DB::table('knowledgebase')->where('id', $id)->update([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('admin.knowledgebase')->with('success', "You have successfully edited announcement #$id!");
    }
}