<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
use Log;
use Auth;
use Rainwater\Active\Active as Active;
use Settings;
use App\Models\Env;
use Products;

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
        return json_encode(Products::orderBy('id')->get());
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
        return json_encode(DB::table('product_sections')->orderBy('order')->get());
    }

    public function products_edit(Request $request)
    {
        if($request->get('id') == "create") {
            Products::insert([
                'name' => $request->get('name'),
                'price' => $request->get('price'),
                'description' => $request->get('description'),
                'category' => $request->get('category'),
            ]);
            $id = Products::latest()->first()->id;    
        } else {
            Products::where('id', $request->get('id'))->update([
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
                    'order' => $i,
                ]);
            } else {
                DB::table('product_sections')->where('id', $array[$i]["id"])->update([
                    'product_id' => $id,
                    'name' => $array[$i]["name"],
                    'content' => $array[$i]["content"],
                    'type' => $array[$i]["type"],
                    'order' => $i,
                ]);
            }
        }

        return "Working";
    }

    // OAuth2 API
    public function oauth2_status(Request $request) {
        if ($request->get('oauth2') == "google") {
            if (Settings::key('GoogleStatus') == 1) {
                DB::table('settings')->where('key', "GoogleStatus")->update([
                    'value' => 0,
                ]);
            } else {
                DB::table('settings')->where('key', "GoogleStatus")->update([
                    'value' => 1,
                ]);
            }
        } elseif ($request->get('oauth2') == "discord") {
            if (Settings::key('DiscordStatus') == 1) {
                DB::table('settings')->where('key', "DiscordStatus")->update([
                    'value' => 0,
                ]);
            } else {
                DB::table('settings')->where('key', "DiscordStatus")->update([
                    'value' => 1,
                ]);
            }
        } elseif ($request->get('oauth2') == "github") {
            if (Settings::key('GithubStatus') == 1) {
                DB::table('settings')->where('key', "GithubStatus")->update([
                    'value' => 0,
                ]);
            } else {
                DB::table('settings')->where('key', "GithubStatus")->update([
                    'value' => 1,
                ]);
            }
        }

        return "Working";
    }

    public function oauth2_refresh() {
        $status = [];

        $status[0]["status"] = Settings::key('GoogleStatus');
        $status[0]["client_id"] = env('GOOGLE_CLIENT_ID');
        $status[0]["client_secret"] = env('GOOGLE_CLIENT_SECRET');

        $status[1]["status"] = Settings::key('DiscordStatus');
        $status[1]["client_id"] = env('DISCORD_CLIENT_ID');
        $status[1]["client_secret"] = env('DISCORD_CLIENT_SECRET');

        $status[2]["status"] = Settings::key('GithubStatus');
        $status[2]["client_id"] = env('GITHUB_CLIENT_ID');
        $status[2]["client_secret"] = env('GITHUB_CLIENT_SECRET');

        return $status;
    }

    public function oauth2_update(Request $request) {
        if($request->get('oauth2') == "google") {
            Env::set(['GOOGLE_CLIENT_ID', $request->get('clientid')]);
            Env::set(['GOOGLE_CLIENT_SECRET', $request->get('clientsecret')]);
        } elseif($request->get('oauth2') == "discord") {
            Env::set(['DISCORD_CLIENT_ID', $request->get('clientid')]);
            Env::set(['DISCORD_CLIENT_SECRET', $request->get('clientsecret')]);
        } elseif($request->get('oauth2') == "github") {
            Env::set(['GITHUB_CLIENT_ID', $request->get('clientid')]);
            Env::set(['GITHUB_CLIENT_SECRET', $request->get('clientsecret')]);
        }

        return;
    }

    public function announcement_create(Request $request) {
        DB::table('announcements')->insert([
            'name' => $request->get('title'),
            'description' => $request->get('description'),
        ]);

        return;
    }

    public function announcement_refresh() {
        return json_encode(DB::table('announcements')->get());
    }

    public function announcement_modal() {
        return json_encode(DB::table('announcements')->get());
    }
}
