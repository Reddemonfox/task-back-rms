<?php

namespace App\Listeners;

use App\Events\RegistrationEvent;
use App\Mail\Registration;
use App\Services\UtilityService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class RegistrationEventListener
{
    private $utilityService;

    /**
     * Create the event listener.
     *
     * @param UtilityService $utilityService
     */
    public function __construct(UtilityService $utilityService)
    {
        $this->utilityService = $utilityService;
    }

    /**
     * Handle the event.
     *
     * @param  RegistrationEvent $event
     * @return void
     */
    public function handle(RegistrationEvent $event)
    {
        Mail::to($event->user)->send(new Registration($event->user));
    }
}
