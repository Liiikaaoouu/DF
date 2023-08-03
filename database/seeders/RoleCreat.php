<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleCreat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = Permission::all();
        if (!Role::where('name', 'super-admin')->exists()) {
            $superad = Role::create(['name' => 'super-admin']);
            $superad->givePermissionTo($permission);
        }
        if (!Role::where('name', 'user')->exists()) {
            $us = Role::create(['name' => 'user']);
            $us->givePermissionTo('show ticket', 'create commit');
        }
        if (!Role::where('name', 'manager')->exists()) {
            $man = Role::create(['name' => 'manager']);
            $man->givePermissionTo('create ticket', 'update ticket', 'show ticket', 'create commit');
        }
        if (!Role::where('name', 'admin')->exists()) {
            $ad = Role::create(['name' => 'admin']);
            $ad->givePermissionTo($permission);
        }
    }
}
