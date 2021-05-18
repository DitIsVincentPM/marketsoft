<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\InputCheck as InputCheck;
use DB;

class AnnouncementsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
        $announcements = DB::table('announcements')->get();

        return view('Admin.announcements', [
            'announcements' => $announcements,
        ]);
    }

    public function createnew(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        
        $error = InputCheck::check([$name, $description]);
        if($error != false) {
            return redirect()->route('admin.announcements')->with('error', $error);
        }

        DB::table('announcements')->insert([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('admin.announcements')->with('success', "You have successfully created a new announcement!");
    }

    public function delete(Request $request, $id)
    {
        DB::table('announcements')->where('id', $id)->delete();

        return redirect()->route('admin.announcements')->with('success', "You have successfully deleted the announcement #$id!");
    }

    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        $error = InputCheck::check([$name, $description]);
        if($error != false) {
            return redirect()->route('admin.announcements')->with('error', $error);
        }

        DB::table('announcements')->where('id', $id)->update([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('admin.announcements')->with('success', "You have successfully edited announcement #$id!");
    }
}
