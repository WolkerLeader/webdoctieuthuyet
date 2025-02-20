<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        'App\Events\BookCreated' => [
            'App\Listeners\SendPendingBookNotification',
        ],
        'App\Events\AuthorCreated' => [
            'App\Listeners\AuthorRoleNotification',
        ],
        'App\Events\StoryCreated' => [
            'App\Listeners\SendStoryApprovedNotification',
        ],
        'App\Events\UserCreated' => [
            'App\Listeners\AuthorApprovedNotification',
        ],
        'App\Events\StoryFollowed' => [
            'App\Listeners\SendNewFollowerNotification',
        ],
        'App\Events\NewChapterAdded' => [
            'App\Listeners\NotifyFollowersOfNewChapter',
        ],
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
