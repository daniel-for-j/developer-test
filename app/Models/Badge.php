<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $table = 'user_badges';

    protected $fillable = [
        'current_badge',
        'user_id',
        'achievements'
    ];
}
