<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_name extends Model
{
    use HasFactory;
    protected $fillable = [
        'role_id',
        'promission',
    ];
}
