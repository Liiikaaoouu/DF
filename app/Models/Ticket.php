<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = false;

    protected $fillable = [
        'name_project',
        'name_of_the_manager',
        'email_of_the_manager',
        'start_date_of_execution',
        'status',
    ];
    public function user(){
        return $this->belongsToMany(User::class, 'ticket_users', 'ticket_id', 'user_id');
    }

}
