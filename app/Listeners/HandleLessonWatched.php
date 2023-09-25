<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Comment;
use App\Models\LessonUser;
use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class HandleLessonWatched
{
   

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {

    //Lesson and User objects from Event 
     $lesson = $event->lesson;
     $user = $event->user;
     $lessonUser = LessonUser::where('user_id',$user->id)->first();


    //  Increments the watch column on the DB
     $lessonUser->watched += 1;
     $result = $lessonUser->save();

    //  After successful save
     if($result){
        $watchTimes = $lessonUser->watched;

        // Assign Achievements depending on watchTimes
        switch ($watchTimes){
            case 1:
                event(new AchievementUnlocked("First Lesson Watched",$user));
            break;

            case 5:
                event(new AchievementUnlocked("5 Lessons Watched",$user));
            break;

            case 10:
                event(new AchievementUnlocked("10 Lessons Watched",$user));
            break;

            case 25:
                event(new AchievementUnlocked("25 Lessons Watched",$user));
            break;

            case 50:
                event(new AchievementUnlocked("50 Lessons Watched",$user));
            break;

          
      
        }
     }



    }
}
