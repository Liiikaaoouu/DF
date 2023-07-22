<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\StoreRequest;
use App\Http\Requests\Ticket\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::all();
        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tickets = Ticket::all();
        return view('ticket.create', compact('tickets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Ticket::create($data);
        return redirect()->route('ticket.index');
    }

    /**
     * Display the specified resource.
     */
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
        return view('ticket.edit', compact('tickets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Ticket $tickets)
    {
        $this->authorize('update', $tickets);
        $data = $request->validate([
            'name_project' => 'required|string',
            'name_of_the_manager' => 'required|string',
            'email_of_the_manager' => 'nullable|email',
            'start_date_of_execution' => 'nullable|date',
            'status' => 'nullable|string',
        ]);
        $tickets->update($data);
        dd($tickets->toSql(), $tickets->getBindings());
        return redirect()->route('ticket.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $tickets)
    {
        $this->authorize('delete', $tickets);
        $tickets->delete();
        return redirect()->route('ticket.index');
        // $tickets->delete();
        // return redirect()->route('ticket.index');
    }
}
