<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
use Log;
use Auth;

class Controller extends BaseController
{
    // Users API
    public function user(Request $request)
    {
        $id = $request->get('id');
        $DB = DB::table('users')->where('id', $id)->first();
        return json_encode($DB);
    }
    public function users(Request $request)
    {
        $DB = DB::table('users')->get();
        return json_encode($DB);
    }
    public function userssearch(Request $request)
    {
        $id = $request->get('query');
        $DB = DB::table('users')->orWhere('id', 'like', "%{$id}%")->orWhere('name', 'like', "%{$id}%")->orWhere('firstname', 'like', "%{$id}%")->orWhere('lastname', 'like', "%{$id}%")->orWhere('email', 'like', "%{$id}%")->get();
        return json_encode($DB);
    }

    // Tickets API
    public function ticketcomments(Request $request)
    {
        $id = $request->get('id');
        $DB = DB::table('ticket_replies')->where('ticket_id', $id)->latest()->get();
        return json_encode($DB);
    }

    public function tickets(Request $request)
    {
        $DB = DB::table('tickets')->get();
        return json_encode($DB);
    }

    public function ticketssearch(Request $request)
    {
        $id = $request->get('query');
        $DB = DB::table('tickets')->orWhere('name', 'like', "%{$id}%")->orWhere('email', 'like', "%{$id}%")->get();
        return json_encode($DB);
    }

    public function ticketcategorys(Request $request)
    {
        $DB = DB::table('ticket_categories')->get();
        return json_encode($DB);
    }

    public function ticketcategoryssearch(Request $request)
    {
        $id = $request->get('query');
        $DB = DB::table('ticket_categories')->orWhere('name', 'like', "%{$id}%")->orWhere('description', 'like', "%{$id}%")->get();
        return json_encode($DB);
    }

    public function ticketcategorycreate(Request $request)
    {
        $name = $request->get('name');
        $description = $request->get('description');

        DB::table('ticket_categories')->insert([
            'name' => $name,
            'description' => $description,
        ]);

    }

    public function ticketcategoryget(Request $request)
    {
        $DB = DB::table('ticket_categories')->where('id', $request->get('id'))->first();
        return json_encode($DB);
    }

    public function ticketcategoryupdate(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $description = $request->get('description');

        DB::table('ticket_categories')->where('id', $id)->update([
            'name' => $name,
            'description' => $description,
        ]);

        return;
    }

    // Roles API
    public function roles(Request $request)
    {
        $DB = DB::table('roles')->get();
        return json_encode($DB);
    }
}
