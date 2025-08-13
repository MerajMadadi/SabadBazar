<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyTicketRequest;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    admin
    public function index()
    {
        $tickets = Ticket::orderby('created_at', 'desc')->get();
        return view('tickets-for-admin', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function my_tickets()
    {
        $tickets = Ticket::where('user_id', Auth::id())->latest()->paginate(10);
        return view('my-tickets', compact('tickets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        Ticket::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'در انتظار'
        ]);

        return redirect('/my-tickets');
    }


    public function show_reply(Ticket $ticket)
    {
        $ticket = Ticket::where('id', $ticket->id)->first();
        return view('ticket-reply', compact('ticket'));
    }

    public function reply(ReplyTicketRequest $request, Ticket $ticket)
    {
        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);
        Ticket::where('id', $ticket->id)->update([
            'status' => 'پاسخ داده شده'
        ]);
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::where('id', $id)->firstOrFail();
        $ticket_replies = $ticket->ticket_replies()->get();
        return view('ticket-show', compact('ticket', 'ticket_replies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function ticket()
    {
        return view('ticket');
    }

    /**
     * Remove the specified resource from storage.
     */
    /*     close ticket*/
    public function close(string $id)
    {
        Ticket::where('id', $id)->update([
            'status' => 'بسته شده'
        ]);

        return redirect()->route('tickets.admin');
    }

    public function destroy(string $id)
    {
        Ticket::where('id', $id)->delete();
        return redirect()->route('tickets.admin');
    }
}
