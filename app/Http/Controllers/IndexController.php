<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Events\RealTimeMessage as Message;
use App\Models\Products;
use App\Models\Announcements;
use DB;
use Auth;

class IndexController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Index()
    {
        $products = Products::latest()->paginate(4);
        $announcements = Announcements::latest()->paginate(2);

        return view('index', [
            'products' => $products,
            'announcements' => $announcements,
        ]);
    }
    
    public function Banned()
    {
        if(!Auth::check()) {
           return redirect()->route('auth.login'); 
        }

        if(Auth::user()->is_banned == "0") {
            return redirect()->route('index')->with('error', "Only banned members can view the banned page!");
        }

        return view('banned');
    }
    
}
