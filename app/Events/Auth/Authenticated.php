<?php

namespace App\Events\Auth;

/** 
 * Authentication event when the user is authorized.
 */
class Authenticated
{
    /**
     * Create a new instance of the data API response event.
     */
    public function __construct(
        public array $response
    ) {}
}
