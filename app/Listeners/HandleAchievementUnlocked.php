<?php

namespace App\Listeners;

use App\Models\Achievement;
use App\Events\BadgeUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleAchievementUnlocked
{
   

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $achievement_name = $event->achievement_name;
        $user = $event->user;

        $achievement = new Achievement;
        $achievement->user_id = $user->id;
        $achievement->title = $achievement_name;
        // This checks the kind of achievement it is(watch or comment) before storing in the DB
        if(strpos($achievement_name,'Comment')!== false){
            $achievement->type = 'comment';
        }
        else {
        $achievement->type = 'watch';
        }

        $result = $achievement->save();

        $achievements = Achievements::where('user_id',$user->id)->get();
        $noOfAchievements = count($achievements);

        switch($noOfAchievements){
            case $noOfAchievements < 4;
            event(new BadgeUnlocked("Beginner",$user));
            break;

            case $noOfAchievements >= 4 && $noOfAchievements < 8;
            event(new BadgeUnlocked("Intermediate",$user));
            break;

            case $noOfAchievements >= 8 && $noOfAchievements < 10;
            event(new BadgeUnlocked("Advanced",$user));
            break;

            case $noOfAchievements >= 10;
            event(new BadgeUnlocked("Master",$user));
            break;
        }

    }
}
