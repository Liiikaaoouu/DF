<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tickets = Ticket::all();
        if ($tickets->isEmpty()){
            $users = User::factory(5)->create(); 
            foreach ($users as $user) {
                $userTickets = $tickets->random(1);
                $user->tickets()->attach($userTickets);
            }
            foreach ($tickets as $ticket) {
                $userId = $users->random()->id;
                $ticket->user_id = $userId;
                $ticket->save();
            }
        }else{
            Ticket::factory(10)->create();
            $users = User::factory(5)->create(); 
            foreach ($users as $user) {
                $userTickets = $tickets->random(1);
                $user->tickets()->attach($userTickets);
            }
            foreach ($tickets as $ticket) {
                $userId = $users->random()->id;
                $ticket->user_id = $userId;
                $ticket->save();
            }
        }
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

