<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Achievement;
use App\Models\Badge;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function index(User $user)
    {

        $userId = $user->id;
        // All Unlocked Achievements
        $achievementsByName = [];
        $unlockedAchievements = Achievement::where('user_id',$userId)->get();
        foreach($unlockedAchievements as $achievemnt){
            array_push($achievementsByName,$achievemnt->title);
        }

        // Next achievements
        $allAchievements = ["First Lesson Watched", "5 Lessons Watched", "10 Lessons Watched", "25 Lessons Watched", "50 Lessons Watched", "First Comment Written", "3 Comments Written", "5 Comments Written", "10 Comments Written", "20 Comments Written"];
        $nextAchievements = array_diff($allAchievements,$achievementsByName);


        // Current Badge
        $currentBadge = Badge::where('user_id',$userId)->first();



        // Next Badge
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
                $nextBadge = 'You are at the current highest Badge obtainable';
            break;


        }

        // Number of achievements left to unlock
        $noOfAchievementsLeft = count($nextAchievements); 
        $remainingToUnlockNextBadge= $currentBadge->achievements_needed - $unlockedAchievements; 



        return response()->json([
            'unlocked_achievements' => $achievementsByName,
            'next_available_achievements' => $nextAchievements,
            'current_badge' => $currentBadge->current_badge,
            'next_badge' => $nextBadge,
            'remaing_to_unlock_next_badge' => $remainingToUnlockNextBadge
        ]);
    }
}
