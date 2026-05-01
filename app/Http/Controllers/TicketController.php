<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Show all tickets for user
     */
    public function index()
    {
        $tickets = Ticket::where('poster_id', Auth::id())
            ->where('deleted', false)
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show ticket details
     */
    public function show($id)
    {
        $ticket = Ticket::with('ticketDetails')
            ->where('id', $id)
            ->where('poster_id', Auth::id())
            ->firstOrFail();

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show create ticket form
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store ticket
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:100',
            'description' => 'required|string|max:3000',
            'type' => 'required|in:Support,Complaint,Others',
        ]);

        $ticket = Ticket::create([
            'poster_id' => Auth::id(),
            'subject' => $request->subject,
            'description' => $request->description,
            'type' => $request->type,
            'status' => 'Open',
        ]);

        // Add initial ticket detail
        TicketDetail::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'description' => $request->description,
        ]);

        return redirect()->route('tickets.show', $ticket->id)
            ->with('success', 'Ticket created successfully!');
    }

    /**
     * Add reply to ticket
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:1000',
        ]);

        $ticket = Ticket::findOrFail($id);

        // Check authorization
        if ($ticket->poster_id !== Auth::id() && Auth::user()->role !== 'Administrator') {
            abort(403);
        }

        TicketDetail::create([
            'ticket_id' => $id,
            'user_id' => Auth::id(),
            'description' => $request->description,
        ]);

        $ticket->update(['status' => 'Answered']);

        return back()->with('success', 'Reply added!');
    }

    /**
     * Admin: Show all tickets
     */
    public function adminIndex()
    {
        if (Auth::user()->role !== 'Administrator') {
            abort(403);
        }

        $tickets = Ticket::with('poster')
            ->where('deleted', false)
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Admin: Show ticket details
     */
    public function adminShow($id)
    {
        if (Auth::user()->role !== 'Administrator') {
            abort(403);
        }

        $ticket = Ticket::with('ticketDetails')
            ->findOrFail($id);

        return view('admin.tickets.show', compact('ticket'));
    }

    /**
     * Admin: Update ticket status
     */
    public function updateStatus(Request $request, $id)
    {
        if (Auth::user()->role !== 'Administrator') {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:Open,Answered,Closed',
        ]);

        Ticket::findOrFail($id)->update(['status' => $request->status]);

        return back()->with('success', 'Ticket status updated!');
    }
}
