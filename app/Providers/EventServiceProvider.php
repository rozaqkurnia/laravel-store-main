<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        // \App::bindMethod(\App\Jobs\TestJob::class . '@handle', function($job){
        //     return $job->handle();
        // });

        \App::bindMethod(\App\Jobs\ProductCreated::class . '@handle', function($job){
            return $job->handle();
        });
        \App::bindMethod(\App\Jobs\ProductUpdated::class . '@handle', function($job){
            return $job->handle();
        });
        \App::bindMethod(\App\Jobs\ProductDeleted::class . '@handle', function($job){
            return $job->handle();
        });
    }
}
