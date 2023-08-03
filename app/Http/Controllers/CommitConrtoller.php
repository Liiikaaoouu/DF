<?php

namespace App\Http\Controllers;

use App\Models\Commit;
use App\Models\Ticket;
use Illuminate\Http\Request;

class CommitConrtoller extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $ticket = session('current_ticket');
        return view('commit.create', compact('ticket'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'ticket_id' => 'required|exists:tickets,id'
        ]);

        Commit::create([
            'content' => $request->input('content'),
            'ticket_id' => $request->input('ticket_id'),
            'user_id' => auth()->user()->id,
        ]);

        $ticket = Ticket::findOrFail($request->input('ticket_id'));

        $commits = Commit::where('ticket_id', $ticket->id)->with('user')->get();


        return redirect()->route('ticket.show', $request->input('ticket_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $commit = Commit::findOrFail($id);
        $ticket = session('current_ticket');
        return view('commit.edit', compact('commit', 'ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $commit = Commit::findOrFail($id);
        $commit->content = $request->input('content');
        $commit->save();
        $ticket = Ticket::findOrFail($request->input('ticket_id'));
        $commits = Commit::where('ticket_id', $ticket->id)->with('user')->get();

        return redirect()->route('ticket.show', $request->input('ticket_id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $commit = Commit::findOrFail($id);
        $tickets = Ticket::findOrFail($commit->ticket_id);
        $deletedCommentUser = $commit->user->name;
        $commit->delete();
        session()->flash('deleted_comment_user', $deletedCommentUser);

        return redirect()->route('ticket.show', $tickets);
    }
}
