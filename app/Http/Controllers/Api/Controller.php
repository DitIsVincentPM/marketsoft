<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
use Log;
use Auth;
use Rainwater\Active\Active as Active;

class Controller extends BaseController
{

    // Users API
    public function user(Request $request)
    {
        $id = $request->get('id');
        return json_encode(DB::table('users')->where('id', $id)->first());
    }

    public function users(Request $request)
    {
        $id = $request->get('query');
        return json_encode(DB::table('users')->orWhere('id', 'like', "%{$id}%")->orWhere('name', 'like', "%{$id}%")->orWhere('firstname', 'like', "%{$id}%")->orWhere('lastname', 'like', "%{$id}%")->orWhere('email', 'like', "%{$id}%")->get());
    }

    public function usersedit(Request $request)
    {
        $id = $request->get('id');
        DB::table('users')->where('id', $id)->update([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'is_banned' => $request->get('ban'),
            'role_id' => $request->get('role'),
        ]);

        return true;
    }


    // Tickets API
    public function ticketcomments(Request $request)
    {
        $id = $request->get('id');
        return json_encode(DB::table('ticket_replies')->where('ticket_id', $id)->latest()->get());
    }

    public function tickets(Request $request)
    {
        return json_encode(DB::table('tickets')->get());
    }

    public function ticketssearch(Request $request)
    {
        $id = $request->get('query');
        return json_encode(DB::table('tickets')->orWhere('name', 'like', "%{$id}%")->orWhere('email', 'like', "%{$id}%")->get());
    }

    public function ticketcategorys(Request $request)
    {
        return json_encode(DB::table('ticket_categories')->get());
    }

    public function ticketcategoryssearch(Request $request)
    {
        $id = $request->get('query');
        return json_encode(DB::table('ticket_categories')->orWhere('name', 'like', "%{$id}%")->orWhere('description', 'like', "%{$id}%")->get());
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
        return json_encode(DB::table('ticket_categories')->where('id', $request->get('id'))->first());
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
        return json_encode(DB::table('roles')->get());
    }
    public function role(Request $request)
    {
        return json_encode(DB::table('roles')->where('id', $request->get('id'))->first());
    }

    public function activeusers(Request $request)
    {
        $active_users = Active::users(3)->get();
        $users_online = count($active_users) + count(Active::guests(3)->get());

        return $users_online;
    }

    // Products API
    public function products()
    {
        return json_encode(DB::table('products')->get());
    }

    public function products_categorys()
    {
        return json_encode(DB::table('product_categorys')->get());
    }

    public function products_images()
    {
        return json_encode(DB::table('product_images')->get());
    }

    public function products_sections()
    {
        return json_encode(DB::table('product_sections')->get());
    }

    public function products_edit(Request $request)
    {
        if($request->get('id') == "create") {
            DB::table('products')->insert([
                'name' => $request->get('name'),
                'price' => $request->get('price'),
                'description' => $request->get('description'),
                'category' => $request->get('category'),
            ]);
            $id = DB::table('products')->latest()->first()->id;    
        } else {
            DB::table('products')->where('id', $request->get('id'))->update([
                'name' => $request->get('name'),
                'price' => $request->get('price'),
                'description' => $request->get('description'),
                'category' => $request->get('category'),
            ]);
            $id = $request->get('id');    
        }

        for ($i = 0; $i < count($request->get('sections')); $i++) {
            $array = $request->get('sections');
            if ($array[$i]["name"] == "del") {
                DB::table('product_sections')->where('id', $array[$i]["id"])->delete();
            } elseif($array[$i]["id"] == "null"){
                DB::table('product_sections')->insert([
                    'product_id' => $id,
                    'name' => $array[$i]["name"],
                    'content' => $array[$i]["content"],
                    'type' => $array[$i]["type"],
                ]);
            } else {
                DB::table('product_sections')->where('id', $array[$i]["id"])->update([
                    'product_id' => $id,
                    'name' => $array[$i]["name"],
                    'content' => $array[$i]["content"],
                    'type' => $array[$i]["type"],
                ]);
            }
        }

        return "Working!!!!!!";
    }
}
