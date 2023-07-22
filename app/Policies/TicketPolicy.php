<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ticket;

class TicketPolicy
{
    public function update(User $user, Ticket $ticket)
    {
        // Проверка, что пользователь имеет роль "admin" для обновления записи
        return $user->role === 'admin';
    }

    public function delete(User $user, Ticket $ticket)
    {
        // Проверка, что пользователь имеет роль "admin" для удаления записи
        return $user->role === 'admin';
    }
}
