<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $permission = Permission::all();
        if (!Role::where('name', 'user')->exists()) {
            $us = Role::create(['name' => 'user']);
            $us->givePermissionTo('show ticket');
        }
        if (!Role::where('name', 'manager')->exists()) {
            $man = Role::create(['name' => 'manager']);
            $man->givePermissionTo('create ticket', 'update ticket', 'show ticket');
        }
        if (!Role::where('name', 'admin')->exists()) {
            $ad = Role::create(['name' => 'admin']);
            $ad->givePermissionTo($permission);
        }
        
        $user = User::create([
            'email' => 'user@gmail.com',
            'name' => 'user',
            'password' => bcrypt('x5410041'),
        ]);

        $userId = $user->id;
        $us->update(['team_id' => $userId]);
        $us->save();

        $user->assignRole('user');

        $manager = User::create([
            'email' => 'manager@gmail.com',
            'name' => 'manager',
            'password' => bcrypt('x5410041'),
        ]);

        $manadgerId = $manager->id;
        $man->update(['team_id' => $manadgerId]);
        $man->save();

        $manager->assignRole('manager');

        $admin = User::create([
            'email' => 'ad@gmail.com',
            'name' => 'ad',
            'password' => bcrypt('x5410041'),
        ]);

        $adminId = $admin->id;
        $ad->update(['team_id' => $adminId]);
        $ad->save();

        $admin->assignRole('admin');

        $users =  User::all();

        $tickets = Ticket::factory(10)->create();

        foreach ($tickets as $ticket) {
            $ticketUsers = $users->random();
            $ticket->user()->sync($ticketUsers);
            $ticket->save();
        }

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

