<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\InputCheck as InputCheck;
use DB;

class SellerController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sellerrequests()
    {
        $requests = DB::table('seller_requests')->get();

        return view('Admin.seller-requests', [
            'requests' => $requests,
        ]);
    }

    public function sellerupdate(Request $statusrequest)
    {
        $status = $statusrequest->input('status');
        $id = $statusrequest->input('id');

        $error = InputCheck::check([$id, $status]);
        if($error != false) {
            return redirect()->route('admin.sellerrequests')->with('error', $error);
        }

        DB::table('seller_requests')->where('id', $id)->update([
            'status' => $status,
        ]);

        return redirect()->route('admin.sellerrequests')->with('success',"You updated the status of the seller request!");
    }
}