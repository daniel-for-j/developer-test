<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleCommentWritten
{
  

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        
    $comment = $event->comment;

    $user = User::where('user_id',$comment->user_id)->first();

    // All comments that belong to the user
    $comments = Comment::where('user_id', $comment->user_id)->get();

    $numberOfComments = count($comments);

    
        switch ($numberOfComments){
            case $numberOfComments >= 1 && $numberOfComments < 3;
            event(new AchievementUnlocked("First Comment Written",$user));
            break;

            case $numberOfComments >= 3 && $numberOfComments < 5;
            event(new AchievementUnlocked("3 Comments Written",$user));
            break;

            case  $numberOfComments >= 5 && $numberOfComments < 10;
            event(new AchievementUnlocked("5 Comments Written",$user));
            break;

            case  $numberOfComments >= 10 && $numberOfComments < 20;
            event(new AchievementUnlocked("10 Comments Written",$user));
            break;

            case  $numberOfComments >= 20;
            event(new AchievementUnlocked("20 Comments Written",$user));
            break;

            default;
            break;
      
        }
    
    }
}