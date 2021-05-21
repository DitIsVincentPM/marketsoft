<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Rainwater\Active\Active as Active;
use App\Helpers\Env;
use App\Models\Users;
use App\Models\Tickets;
use App\Models\Ticket_Categories;
use App\Models\Ticket_Replies;
use App\Models\Roles;
use App\Models\Role_Permissions;
use App\Models\Products;
use App\Models\Product_Images;
use App\Models\Product_Sections;
use App\Models\Product_Categories;
use App\Models\Announcements;
use App\Models\Settings;
use App\Models\Knowledgebase;
use App\Models\Knowledgebase_Categories;
use App\Helpers\Settings as SettignsHelper;
use Hash;

class Controller extends BaseController
{

    // Users API
    public function user(Request $request)
    {
        $id = $request->get('id');
        return json_encode(Users::where('id', $id)->first());
    }

    public function users(Request $request)
    {
        $id = $request->get('query');
        return json_encode(Users::orWhere('id', 'like', "%{$id}%")->orWhere('name', 'like', "%{$id}%")->orWhere('firstname', 'like', "%{$id}%")->orWhere('lastname', 'like', "%{$id}%")->orWhere('email', 'like', "%{$id}%")->get());
    }

    public function usersedit(Request $request)
    {
        $id = $request->get('id');
        Users::where('id', $id)->update([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'is_banned' => $request->get('ban'),
            'role_id' => $request->get('role'),
        ]);

        return true;
    }

    public function userscreate(Request $request) {
        $password = $request->get('password1');
        $password = Hash::make($password);

        Users::insert([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'role_id' => $request->get('role'),
            'password' => $password,
            'is_banned' => 0,
        ]);

        return;
    }


    // Tickets API
    public function ticketcomments(Request $request)
    {
        $id = $request->get('id');
        return json_encode(Ticket_Replies::where('ticket_id', $id)->latest()->get());
    }

    public function tickets(Request $request)
    {
        return json_encode(Tickets::get());
    }

    public function ticketssearch(Request $request)
    {
        $id = $request->get('query');
        return json_encode(Tickets::orWhere('name', 'like', "%{$id}%")->orWhere('email', 'like', "%{$id}%")->get());
    }

    public function ticketcategorys(Request $request)
    {
        return json_encode(Ticket_Categories::get());
    }

    public function ticketcategoryssearch(Request $request)
    {
        $id = $request->get('query');
        return json_encode(Ticket_Categories::orWhere('name', 'like', "%{$id}%")->orWhere('description', 'like', "%{$id}%")->get());
    }

    public function ticketcategorycreate(Request $request)
    {
        $name = $request->get('name');
        $description = $request->get('description');

        Ticket_Categories::insert([
            'name' => $name,
            'description' => $description,
        ]);
    }

    public function ticketcategoryget(Request $request)
    {
        return json_encode(Ticket_Categories::where('id', $request->get('id'))->first());
    }

    public function ticketcategoryupdate(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $description = $request->get('description');

        Ticket_Categories::where('id', $id)->update([
            'name' => $name,
            'description' => $description,
        ]);

        return;
    }

    // Roles API
    public function roles(Request $request)
    {
        return json_encode(Roles::get());
    }
    public function role(Request $request)
    {
        return json_encode(Roles::where('id', $request->get('id'))->first());
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
        return json_encode(Product_Categories::get());
    }

    public function products_images()
    {
        return json_encode(Product_Images::get());
    }

    public function products_sections()
    {
        return json_encode(Product_Sections::orderBy('order')->get());
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
                Product_Sections::where('id', $array[$i]["id"])->delete();
            } elseif($array[$i]["id"] == "null"){
                Product_Sections::insert([
                    'product_id' => $id,
                    'name' => $array[$i]["name"],
                    'content' => $array[$i]["content"],
                    'type' => $array[$i]["type"],
                    'order' => $i,
                ]);
            } else {
                Product_Sections::where('id', $array[$i]["id"])->update([
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
            if (SettignsHelper::key('GoogleStatus') == 1) {
                Settings::where('key', "GoogleStatus")->update([
                    'value' => 0,
                ]);
            } else {
                Settings::where('key', "GoogleStatus")->update([
                    'value' => 1,
                ]);
            }
        } elseif ($request->get('oauth2') == "discord") {
            if (SettignsHelper::key('DiscordStatus') == 1) {
                Settings::where('key', "DiscordStatus")->update([
                    'value' => 0,
                ]);
            } else {
                Settings::where('key', "DiscordStatus")->update([
                    'value' => 1,
                ]);
            }
        } elseif ($request->get('oauth2') == "github") {
            if (SettignsHelper::key('GithubStatus') == 1) {
                Settings::where('key', "GithubStatus")->update([
                    'value' => 0,
                ]);
            } else {
                Settings::where('key', "GithubStatus")->update([
                    'value' => 1,
                ]);
            }
        }

        return "Working";
    }

    public function oauth2_refresh() {
        $status = [];

        $status[0]["status"] = SettignsHelper::key('GoogleStatus');
        $status[0]["client_id"] = env('GOOGLE_CLIENT_ID');
        $status[0]["client_secret"] = env('GOOGLE_CLIENT_SECRET');

        $status[1]["status"] = SettignsHelper::key('DiscordStatus');
        $status[1]["client_id"] = env('DISCORD_CLIENT_ID');
        $status[1]["client_secret"] = env('DISCORD_CLIENT_SECRET');

        $status[2]["status"] = SettignsHelper::key('GithubStatus');
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
        Announcements::insert([
            'name' => $request->get('title'),
            'description' => $request->get('description'),
        ]);

        return;
    }

    public function announcement_refresh() {
        return json_encode(Announcements::get());
    }

    public function announcement_modal() {
        return json_encode(Announcements::get());
    }

    public function knowledgebasecategories(Request $request)
    {
        $id = $request->get('query');
        return json_encode(Knowledgebase_Categories::orWhere('name', 'like', "%{$id}%")->orWhere('description', 'like', "%{$id}%")->get());
    }

    public function knowledgebase(Request $request)
    {
        $id = $request->get('query');
        return json_encode(Knowledgebase::orWhere('name', 'like', "%{$id}%")->orWhere('description', 'like', "%{$id}%")->get());
    }

    public function knowledgebaseget(Request $request)
    {
        return json_encode(Knowledgebase::where('id', $request->get('id'))->first());
    }
    
    public function knowledgebasecategoryget(Request $request)
    {
        return json_encode(Knowledgebase_Categories::where('id', $request->get('id'))->first());
    }

    public function knowledgebasecategoryupdate(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $description = $request->get('description');

        Knowledgebase_Categories::where('id', $id)->update([
            'name' => $name,
            'description' => $description,
        ]);

        return true;
    }

    public function knowledgebasearticleupdate(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $description = $request->get('description');
        $category = $request->get('category');

        Knowledgebase::where('id', $id)->update([
            'name' => $name,
            'description' => $description,
            'category_id' => $category,
        ]);

        return true;
    }

    public function knowledgebasearticlecreate(Request $request)
    {
        $name = $request->get('name');
        $description = $request->get('description');
        $category = $request->get('category');

        Knowledgebase::insert([
            'name' => $name,
            'description' => $description,
            'category_id' => $category,
        ]);

        return true;
    }

    public function knowledgebasecategorycreate(Request $request)
    {
        $name = $request->get('name');
        $description = $request->get('description');

        Knowledgebase_Categories::insert([
            'name' => $name,
            'description' => $description,
        ]);

        return true;
    }
}
