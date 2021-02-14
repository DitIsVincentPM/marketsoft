<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\InputCheck as InputCheck;
use DB;
use Auth;
use Illuminate\Http\Request;

class TicketsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $tickets = DB::table('tickets')->latest()->get();
        $categories = DB::table('ticket_categories')->latest()->get();

        return view('Admin.Modules.TicketSystem.index', [
            'tickets' => $tickets,
            'ticket_categories' => $categories,
        ]);
    }

    public function CategoryCreate(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        DB::table('ticket_categories')->insert([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('admin.tickets')->with('success', "You have successfully created the category <code>$name</code>!");
    }

    public function CategoryUpdate(Request $request, $id)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        DB::table('ticket_categories')->where('id', $id)->update([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('admin.tickets')->with('success', "You have successfully edited the category $name!");
    }

    public function ViewTicket(Request $request, $id)
    {
        $tickets = DB::table('tickets')->where('id', $id)->first();
        $users = DB::table('users')->get();
        $ticketreply = DB::table('ticket_replies')->where('ticket_id', $id)->latest()->get();
        $categories = DB::table('ticket_categories')->latest()->get();

        return view('Admin.Modules.TicketSystem.view', [
            'tickets' => $tickets,
            'users' => $users,
            'ticket_replies' => $ticketreply,
            'categories' => $categories,
        ]);
    }

    public function TicketDelete($id)
    {
        DB::table('tickets')->where('id', $id)->delete();
        DB::table('ticket_replies')->where('ticket_id', $id)->delete();

        return redirect()->route('admin.tickets')->with('success', "You have successfully deleted ticket #$id!");
    }

    public function TicketReply(Request $request, $id)
    {
        $message = $request->input('message');
        $user_id = Auth::user()->id;

        $error = InputCheck::check([$message]);
        if($error != false) {
            return redirect()->route('admin.tickets.view', $id)->with('error', $error);
        }

        DB::table('ticket_replies')->insert([
            'message' => $message,
            'user_id' => $user_id,
            'ticket_id' => $id,
        ]);

        DB::table('tickets')->where('id', $id)->update([
            'status' => 1,
        ]);

        return redirect()->route('admin.tickets.view', $id)->with('success', "You have successfully replied to ticket #$id!");
    }

    public function TicketWhisper(Request $request, $id)
    {
        $message = $request->input('message');
        $user_id = Auth::user()->id;

        $error = InputCheck::check([$message]);
        if($error != false) {
            return redirect()->route('admin.tickets.view', $id)->with('error', $error);
        }

        DB::table('ticket_replies')->insert([
            'message' => $message,
            'user_id' => $user_id,
            'ticket_id' => $id,
            'is_whisper' => 1,
        ]);

        return redirect()->route('admin.tickets.view', $id)->with('success', "You have successfully sent a whisper to ticket #$id!");
    }

    public function CloseTicket(Request $request, $id)
    {
        DB::table('tickets')->where('id', $id)->update([
            'status' => 3,
        ]);

        return redirect()->route('admin.tickets.view', $id)->with('success', "You have successfully marked ticket #$id as closed!");
    }

    public function OpenTicket(Request $request, $id)
    {
        DB::table('tickets')->where('id', $id)->update([
            'status' => 2,
        ]);

        return redirect()->route('admin.tickets.view', $id)->with('success', "You have successfully marked ticket #$id as open!");
    }
}