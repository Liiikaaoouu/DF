<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function user(){
        return $this->belongsToMany(User::class, 'ticket_users');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function commit(){
        return $this->belongsTo(Commit::class);
    }
}
