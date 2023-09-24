<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;


    protected $table = 'user_achievements'; 
    protected $fillable = [
        'title',
        'user_id',
        'type'
    ];
}
