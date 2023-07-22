<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = false;

    protected $fillable = [
        'name_project',
        'name_of_the_manager',
        'email_of_the_manager',
        'start_date_of_execution',
        'status',
    ];

}
