<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home()
    {
        $products = DB::table('products')->latest()->paginate(4);
        $announcements = DB::table('announcements')->latest()->paginate(2);

        return view('index.home', [
            'products' => $products,
            'announcements' => $announcements,
        ]);
    }
    
}
