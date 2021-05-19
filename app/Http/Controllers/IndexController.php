<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Auth;
use App\Events\RealTimeMessage as Message;

class IndexController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Index()
    {
        $products = DB::table('products')->latest()->paginate(4);
        $announcements = DB::table('announcements')->latest()->paginate(2);

        event(new Message('Hello World'));

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
