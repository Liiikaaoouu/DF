<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\StoreRequest;
use App\Http\Requests\Ticket\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::with('user')->get();
        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tickets = Ticket::all();
        $users = User::all();
        $userRoles = [];
        foreach ($tickets as $ticket) {
            $userRoles[$ticket->id] = $ticket->user->pluck('id')->toArray();
        }
        $status = DB::table('tickets')->distinct()->pluck('status');
        return view('ticket.create', compact('tickets', 'users', 'status', 'userRoles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_project' => 'required|string',
            'name_of_the_manager' => 'required|string',
            'email_of_the_manager' => 'nullable|email',
            'start_date_of_execution' => 'nullable|date',
            'status' => 'nullable|string',
            'users' => 'nullable|array', 
        ]);

        $ticket = Ticket::create($data);
        if ($request->has('users')) {
            $ticket->users()->attach($request->input('users'));
        }

        return redirect()->route('ticket.index');
    }

    public function show($id)

    {
        $tickets = Ticket::findOrFail($id);
        return view('ticket.show', compact('tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tickets = Ticket::findOrFail($id);
        $users = User::all();
        $userRoles = $tickets->user->pluck('id')->toArray();
        $status = DB::table('tickets')->distinct()->pluck('status');
        return view('ticket.edit', compact('tickets', 'users', 'status', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name_project' => 'required|string',
            'name_of_the_manager' => 'required|string',
            'email_of_the_manager' => 'nullable|email',
            'status' => 'nullable|string',
            'user' => 'nullable|array',
        ]);
        $ticket = Ticket::findOrFail($id);
        $ticket->update($data);
        if ($request->has('user')) {
            $ticket->user()->sync($request->input('user'));
        } else {
            $ticket->user()->detach();
        }

        return redirect()->route('ticket.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tickets = Ticket::find($id);
        $tickets->delete();
        $tickets->user()->detach();
        return redirect()->route('ticket.index');
    }
}
