<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class SellerController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sellerrequests()
    {
        $requests = DB::table('seller_requests')->get();

        return view('admin.seller-requests', [
            'requests' => $requests,
        ]);
    }

    public function sellerupdate(Request $statusrequest)
    {
        $status = $statusrequest->input('status');
        $id = $statusrequest->input('id');

        DB::table('seller_requests')->where('id', $id)->update([
            'status' => $status,
        ]);

        return redirect()->route('admin.sellerrequests')->with('success',"You updated the status of the seller request!");
    }
}