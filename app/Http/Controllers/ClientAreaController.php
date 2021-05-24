<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\ca_ownedProducts;
use App\Models\ca_Invoices;
use App\Models\Announcements;
use App\Models\Tickets;

class ClientAreaController extends BaseController
{
    public function Index(Request $request)
    {
        $products = ca_ownedProducts::latest()->paginate(3);
        $announcement = Announcements::latest()->first();
        $tickets = Tickets::where('user_id', $request->user()->id)->paginate(3);

        return view('ClientArea.index', [
            'announcement' => $announcement,
            'tickets' => $tickets,
            'products' => $products,
        ]);
    }

    public function invoices(Request $request)
    {
        $invoices = ca_Invoices::where('user_id', $request->user()->id)->get();

        return view('ClientArea.invoices', [
            'invoices' => $invoices,
        ]);
    }

    public function services(Request $request)
    {
        $services = ca_ownedProducts::where('user_id', $request->user()->id)->get();

        return view('ClientArea.services', [
            'services' => $services,
        ]);
    }
}
