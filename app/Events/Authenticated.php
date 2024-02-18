<?php

namespace App\Events;

class Authenticated
{
    /**
     * The data api response.
     *
     * @var array
     */
    public $response;

    /**
     * Create a new event instance.
     */
    public function __construct(array $response)
    {
        $this->response = $response;
    }
}
