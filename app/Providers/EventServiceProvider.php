<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Listeners\HandleLessonWatched;
use App\Listeners\HandleCommentWritten;
use App\Listeners\HandleAchievementUnlocked;
use App\Listeners\HandleBadgeUnlocked;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LessonWatched::class => [
            HandleLessonWatched::class,
        ],
        CommentWritten::class => [
            HandleCommentWritten::class
        ],
        AchievementUnlocked::class => [
            HandleAchievementUnlocked::class 
        ],
        BadgeUnlocked::class => [
            HandleBadgeUnlocked::class 
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
