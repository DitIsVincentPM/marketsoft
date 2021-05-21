<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Helpers\InputCheck;
use App\Models\Announcements;

class AnnouncementsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
        $announcements = Announcements::get();

        return view('Admin.announcements', [
            'announcements' => $announcements,
        ]);
    }

    public function createnew(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        
        Announcements::insert([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('admin.announcements')->with('success', "You have successfully created a new announcement!");
    }

    public function delete(Request $request, $id)
    {
        Announcements::where('id', $id)->delete();

        return redirect()->route('admin.announcements')->with('success', "You have successfully deleted the announcement #$id!");
    }

    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        Announcements::where('id', $id)->update([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('admin.announcements')->with('success', "You have successfully edited announcement #$id!");
    }
}
