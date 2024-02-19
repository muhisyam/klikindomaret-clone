<?php

namespace App\Events\Auth;

use Twilio\Rest\Client;

class MobileVerify
{
    public $attributes, $twilio;

    /**
     * Create a new event instance such as attributes and Twilio client.
     */
    public function __construct(array $attributes) 
    {
        $this->attributes = $attributes;
        $this->twilio = new Client(
            config('services.twilio.id'), 
            config('services.twilio.token'),
        );
    }
}
