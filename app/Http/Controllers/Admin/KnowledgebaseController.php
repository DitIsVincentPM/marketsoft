<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\InputCheck as InputCheck;
use DB;
use Mail;
use Auth;

class KnowledgebaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
        $knowledgebase = DB::table('knowledgebase')->get();
        $categorys = DB::table('knowledgebase_categorys')->get();

        return view('admin.knowledgebase', [
            'knowledgebases' => $knowledgebase,
            'categorys' => $categorys
        ]);
    }

    public function new(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $category_id = $request->input('category');

        $header = "From: support@marketsoft.io\r\n";
        $header.= "MIME-Version: 1.0\r\n";
        $header.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $header.= "X-Priority: 1\r\n";
        
        $status = mail(Auth::user()->email, 'test', "test", $header);
        
        if($status)
        {
            dd('<p>Your mail has been sent!</p>');
        } else {
            dd('<p>Something went wrong. Please try again!</p>');
        }

        $error = InputCheck::check([$name, $description]);
        if ($error != false) {
            return redirect()->route('admin.announcements')->with('error', $error);
        }

        DB::table('knowledgebase')->insert([
            'name' => $name,
            'description' => $description,
            'category_id' => $category_id,
        ]);

        return redirect()->route('admin.knowledgebase')->with('success', "You have successfully created a new knowledgebase article!");
    }

    public function delete(Request $request, $id)
    {
        DB::table('knowledgebase')->where('id', $id)->delete();

        return redirect()->route('admin.knowledgebase')->with('success', "You have successfully deleted the knowledgebase article #$id!");
    }

    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $category_id = $request->input('category');

        $error = InputCheck::check([$name, $description]);
        if ($error != false) {
            return redirect()->route('admin.knowledgebase')->with('error', $error);
        }

        DB::table('knowledgebase')->where('id', $id)->update([
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

        $error = InputCheck::check([$name, $description]);
        if ($error != false) {
            return redirect()->route('admin.announcements')->with('error', $error);
        }

        DB::table('knowledgebase_categorys')->insert([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('admin.knowledgebase')->with('success', "You have successfully created a new category!");
    }

    public function categorydelete(Request $request, $id)
    {
        DB::table('knowledgebase_categorys')->where('id', $id)->delete();

        return redirect()->route('admin.knowledgebase')->with('success', "You have successfully deleted the category #$id!");
    }

    public function categoryupdate(Request $request, $id)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        $error = InputCheck::check([$name, $description]);
        if ($error != false) {
            return redirect()->route('admin.knowledgebase')->with('error', $error);
        }

        DB::table('knowledgebase_categorys')->where('id', $id)->update([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('admin.knowledgebase')->with('success', "You have successfully edited category #$id!");
    }
}
