<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Team;
use App\Models\InputCheck as InputCheck;
use Auth;

class SupportController
{
    public function Tickets()
    {
        $tickets = DB::table('tickets')->where('user_id', '=', Auth::user()->id)->latest()->get();
        $categories = DB::table('ticket_categories')->latest()->get();

        return view('Modules.TicketSystem.ticket', [
            'tickets' => $tickets,
            'categories' => $categories,
        ]);
    }

    public function NewTicket()
    {
        $categories = DB::table('ticket_categories')->latest()->get();

        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error',"You need to be logged in to create a ticket!");
        }

        return view('Modules.TicketSystem.new', [
            'ticket_categories' => $categories,
        ]);
    }

    public function create(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $category = $request->input('category');
        $priority = $request->input('priority');
        $message = $request->input('message');
        $user_id = Auth::user()->id;
        
        $error = InputCheck::check([$name, $email, $category, $priority, $message]);
        if($error != false) {
            return redirect()->route('support.ticket.new')->with('error', $error);
        }

        DB::table('tickets')->insert([
            'name' => $name,
            'email' => $email,
            'category' => $category,
            'priority' => $priority,
            'message' => $message,
            'user_id' => $user_id,
        ]);

        return redirect()->route('support.ticket')->with('success', "You have successfully created a new ticket!");
    }

    public function TicketView(Request $request, $id)
    {
        $tickets = DB::table('tickets')->where('id', $id)->first();
        $users = DB::table('users')->get();
        $ticketreply = DB::table('ticket_replies')->where('ticket_id', $id)->latest()->get();
        $categories = DB::table('ticket_categories')->latest()->get();

        if($tickets == null) {
            return redirect()->route('support.ticket')->with('error', "This ticket does not exist."); 
        }

        if($tickets->user_id != Auth::user()->id) {
            return redirect()->route('support.ticket')->with('error', "This is not your ticket, you cannot view it!");
        }

        return view('Modules.TicketSystem.view', [
            'tickets' => $tickets,
            'users' => $users,
            'ticket_replies' => $ticketreply,
            'categories' => $categories,
        ]);
    }

    public function TicketReplyCreate (Request $request, $id)
    {
        $message = $request->input('message');
        $user_id = Auth::user()->id;
        $tickets = DB::table('tickets')->where('id', $id)->first();

        if($tickets->status == 3) {
            return redirect()->route('support.ticket.view', $id)->with('error', "This ticket is closed, you cannot reply!");
        }

        $error = InputCheck::check([$message]);
        if($error != false) {
            return redirect()->route('support.ticket.view', $id)->with('error', $error);
        }

        DB::table('ticket_replies')->insert([
            'message' => $message,
            'user_id' => $user_id,
            'ticket_id' => $id,
        ]);

        DB::table('tickets')->where('id', $id)->update([
            'status' => 0,
        ]);

        return redirect()->route('support.ticket.view', $id)->with('success', "You have successfully replied to ticket #$id!");
    }
}