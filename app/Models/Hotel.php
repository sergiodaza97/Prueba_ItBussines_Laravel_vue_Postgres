<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'city', 'address', 'nit', 'num_room', 'created_at', 'update_at'
    ];
}
