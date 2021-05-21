<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Ticket_Categories;
use App\Models\Ticket_Replies;
use App\Models\Users;
use App\Models\Roles;
use Auth;

class TicketsController extends BaseController
{
    public function index()
    {
        return view('Admin.Modules.TicketSystem.index');
    }

    public function CategoryCreate(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        Ticket_Categories::insert([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('admin.tickets')->with('success', "You have successfully created the category <code>$name</code>!");
    }

    public function CategoryUpdate(Request $request, $id)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        Ticket_Categories::where('id', $id)->update([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('admin.tickets')->with('success', "You have successfully edited the category $name!");
    }

    public function ViewTicket(Request $request, $id)
    {
        $tickets = Tickets::where('id', $id)->first();
        $users = Users::get();
        $ticketreply = Ticket_Replies::where('ticket_id', $id)->latest()->get();
        $categories = Ticket_Categories::latest()->get();
        $roles = Roles::get();

        return view('Admin.Modules.TicketSystem.view', [
            'tickets' => $tickets,
            'users' => $users,
            'ticket_replies' => $ticketreply,
            'categories' => $categories,
            'roles' => $roles,
        ]);
    }

    public function TicketDelete($id)
    {
        Tickets::where('id', $id)->delete();
        Ticket_Replies::where('ticket_id', $id)->delete();

        return redirect()->route('admin.tickets')->with('success', "You have successfully deleted ticket #$id!");
    }

    public function TicketReply(Request $request, $id)
    {
        $message = $request->input('message');
        $user_id = Auth::user()->id;

        Ticket_Replies::insert([
            'message' => $message,
            'user_id' => $user_id,
            'ticket_id' => $id,
        ]);

        Tickets::where('id', $id)->update([
            'status' => 1,
        ]);

        return redirect()->route('admin.tickets.view', $id)->with('success', "You have successfully replied to ticket #$id!");
    }

    public function TicketWhisper(Request $request, $id)
    {
        $message = $request->input('message');
        $user_id = Auth::user()->id;

        Ticket_Replies::insert([
            'message' => $message,
            'user_id' => $user_id,
            'ticket_id' => $id,
            'is_whisper' => 1,
        ]);

        return redirect()->route('admin.tickets.view', $id)->with('success', "You have successfully sent a whisper to ticket #$id!");
    }

    public function CloseTicket(Request $request, $id)
    {
        Tickets::where('id', $id)->update([
            'status' => 3,
        ]);

        return redirect()->route('admin.tickets.view', $id)->with('success', "You have successfully marked ticket #$id as closed!");
    }

    public function OpenTicket(Request $request, $id)
    {
        Tickets::where('id', $id)->update([
            'status' => 2,
        ]);

        return redirect()->route('admin.tickets.view', $id)->with('success', "You have successfully marked ticket #$id as open!");
    }
}