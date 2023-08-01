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

        $this->call([
            PermissionSeeder::class,
            RoleCreat::class,
            SuperAdmin::class,
        ]);

        $permission = Permission::all();
        if (!Role::where('name', 'super-admin')->exists()) {
            $superad = Role::create(['name' => 'super-admin']);
            $superad->givePermissionTo($permission);
        }
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


        $user->assignRole('user');

        $manager = User::create([
            'email' => 'manager@gmail.com',
            'name' => 'manager',
            'password' => bcrypt('x5410041'),
        ]);


        $manager->assignRole('manager');

        $ad = Role::where('name', 'admin');
        $admin = User::create([
            'email' => 'ad@gmail.com',
            'name' => 'ad',
            'password' => bcrypt('x5410041'),
        ]);

        $admin->assignRole('admin');

        $users =  User::all();

        $tickets = Ticket::factory(10)->create();

        foreach ($tickets as $ticket) {
            $ticketUsers = $users->random();
            $ticket->user()->sync($ticketUsers->id);
            $ticket->save();
        }

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

