<?php

namespace App\Listeners;

use App\Models\Badge;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleBadgeUnlocked
{
   

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $badge_name = $event->badge_name;
        $user = $event->user;

        $badge = Badge::where('user_id',$user->id)->first();
        $badge->current_badge = $badge_name;
        switch($badge_name){
            case 'Beginner':
                $badge->achievements_needed = 0;
            break;

            case 'Intermediate':
                $badge->achievements_needed = 4;
            break;

            case 'Advanced':
                $badge->achievements_needed = 8;
            break;

            case 'Master':
                $badge->achievements_needed = 10;
            break;

        }
        $badge->save();
      

       




    }
}
