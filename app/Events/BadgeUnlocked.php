<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BadgeUnlocked
{
    use Dispatchable, SerializesModels;

    public $badge_name;
    public $user;

    /**
     * Create a new event instance.
     */
    public function __construct($badge_name,User $user)
    {
        $this->badge_name = $badge_name;
        $this->user = $user;
        
    }

   
}
