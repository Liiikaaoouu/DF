<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all()->where('name', '!=', 'super-admin');
        return view('role.index', compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'permissions.*' => 'required|integer|exists:permissions,id',
        ]);

        $newRole = Role::create([
            'name' => $request->name,
        ]);

        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $newRole->syncPermissions($permissions);

        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role, $id)
    {
        $roles = Role::findOrFail($id);
        return view('ticket.show', compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $roles)
    {
        $roles = Role::where('name', '!=', 'super-admin')->findOrFail($roles->id);
        $permissions = Permission::all();

        return view('role.edit', compact('permissions', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $roles)
    {
        $request->validate([
            'name' => 'required|string',
            'permissions' => 'required',
            'permissions.*' => 'required|integer|exists:permissions,id',
        ]);
        $roles = Role::where('name', '!=', 'super-admin')->findOrFail($roles->id);
        $roles->update([
            'name' => $request->name,
        ]);
        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $roles->syncPermissions($permissions);
        
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role, $id)
    {
        $roles = Role::find($id);
        $roles->delete();
        return redirect()->route('ticket.index');
    }
}
