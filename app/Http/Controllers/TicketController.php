<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Commit;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::with('user')->get();
        if (!$tickets->isEmpty()){
            return view('ticket.index', compact('tickets'));
        }else{
            dd("таблица Ticket пустая");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tickets = Ticket::all();
        $users = User::all();
        $status = DB::table('tickets')->distinct()->pluck('status');
        return view('ticket.create', compact('tickets', 'users', 'status', 'categories'));
        
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
            'user' => 'nullable|array', 
            'category_id' => '',
            'attachment' => 'nullable|max:2048', 
        ]);
    
        // $user = User::findOrFail($request->user);
        // $category= Category::FindOrFail($request->category_id);
        // unset($data['user']);
        // $ticket = Ticket::create($data);
        // $ticket->user()->attach($user);
        // $ticket->category()->create($cat);
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $attachmentName = time() . '_' . $attachment->getClientOriginalName();
            $attachment->storeAs('attachments', $attachmentName, 'public');
        }

        $user = $data['user'];
        unset($data['user']);
        $ticket = Ticket::create($data);
        $ticket->user()->sync($user);

        return redirect()->route('ticket.index');
    }

    public function show($id)

    {
        $tickets = Ticket::with('user', 'category')->findOrFail($id);
        $commits = Commit::where('ticket_id', $tickets->id)->with('user')->get();
        $ticket = Ticket::findOrFail($id);
        session(['current_ticket' => $ticket]);
        return view('ticket.show', compact('tickets', 'commits'));
        
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tickets = Ticket::findOrFail($id);
        $users = User::all();
        $userTicket = $tickets->user->pluck('id')->toArray();
        $category = Category::all();
        $status = DB::table('tickets')->distinct()->pluck('status');
        return view('ticket.edit', compact('tickets', 'users', 'status', 'userTicket', 'category'));
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
            'category_id' => '',
            'attachment' => 'nullable|max:2048',
        ]);
        
        $ticket = Ticket::findOrFail($id);
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $attachmentName = time() . '_' . $attachment->getClientOriginalName();
            $attachment->storeAs('attachments', $attachmentName, 'public');
            $ticket->attachment = $attachmentName;
        }
        $user = $data['user'];
        $ticket->user()->sync($user);
        unset($data['user']);
        $ticket->update($data);

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
