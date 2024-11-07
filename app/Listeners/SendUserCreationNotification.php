<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendUserCreationNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        # Now right here, we could add a happy little email notification.
//        Notification::send(User::role('admin')->get(), new AdminNotification("A new user has been created: {event->user->name}"));
        Log::info('User created - ' . $event->user->name);
    }

    public function failed(UserCreated $event, Throwable $exception): void
    {
        Log::error('Notification failed for user ' . $event->user->name);
    }
}
