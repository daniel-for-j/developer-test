<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAchievement;
use App\Models\Achievement;
use App\Models\UserBadge;
use App\Models\Badge;
use App\Models\Lesson;
use App\Models\Comment;
use App\Events\LessonWatched;
use App\Events\CommentWritten;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function index( $user)
    {
        

        $userId = 1;


        // All Unlocked Achievements
        $achievementsByName = [];
        $unlockedAchievements = UserAchievement::where('user_id',$userId)->get();
        foreach($unlockedAchievements as $achievemnt){
            array_push($achievementsByName,$achievemnt->title);
        }

        // Next achievements
        $achievemnts = Achievement::all();
        $allAchievements = [];
        // Pushes all achievement titles into empty array
        foreach($achievemnts as $achievemnt){
            array_push($allAchievements, $achievemnt->title);
        }
        // Subtracts unlocked achievements from total achievements
        $nextAchievements = array_diff($allAchievements,$achievementsByName);
        $readableNextAchievements ="[" . implode(", ", $nextAchievements) . "]";



        // Current UserBadge
        $currentBadge = UserBadge::where('user_id',$userId)->first();


        // Next UserBadge
        $nextBadge;
        switch($currentBadge->current_badge){
            case 'Beginner':
                $nextBadge = 'Intermediate';
            break;

            case 'Intermediate':
                $nextBadge = 'Advanced';
            break;

            case 'Advanced':
                $nextBadge ='Master';
            break;

            case 'Master':
                $nextBadge = 'You are at the current highest UserBadge obtainable';
            break;


        }

        // Number of achievements left to unlock
        $currentBadgeNumber = Badge::where('title', $nextBadge)->first();
        $remainingToUnlockNextBadge= $currentBadgeNumber->achievements_needed - count($unlockedAchievements); 



        return response()->json([
            'unlocked_achievements' => $achievementsByName,
            'next_available_achievements' => $readableNextAchievements,
            'current_badge' => $currentBadge->current_badge,
            'next_badge' => $nextBadge,
            'remaing_to_unlock_next_badge' => $remainingToUnlockNextBadge
        ]);
    }


    public function watch(){

    
        // Lesson
        $lesson = Lesson::find(1);

        // User
        $user = User::find(1);

        event(new LessonWatched($lesson,$user));

    }

    public function comment(){
        $comment = new Comment;
        $comment->body = "We gather dey";
        $comment->user_id = 1;
        $comment->save();

        event(new CommentWritten($comment));
    }
}
