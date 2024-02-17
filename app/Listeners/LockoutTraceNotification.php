<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;

class LockoutTraceNotification
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        // TODO: add to database
        
        Log::info('Locked Out. IP: ' . $event->request->getClientIp() . ', Username: ' . $event->request['mobile_email'] . ', User-Agent: ' . $event->request->userAgent() . ', HTTP Referer: ' . $event->request->httpHost() . '/' . $event->request->path() . '. User locked out due to too many login attempts.');
    }
}
