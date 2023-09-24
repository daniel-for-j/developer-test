<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AchievementUnlocked
{
    use Dispatchable, SerializesModels;

    public $user;
    public $achievement_name;


    /**
     * Create a new event instance.
     */
    public function __construct($achievement_name, User $user)
    {

        $this->user = $user;
        $this->achievement_name = $achievement_name;

    }

  
}
