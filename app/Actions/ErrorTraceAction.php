<?php

namespace App\Actions;

use Illuminate\Support\Str;

class ErrorTraceAction
{
    /**
     * Get information about error located
     *
     * @return array<string-filename, string-line>
     */
    public function execute(): array
    {
        $trace = debug_backtrace()[0];

        return [
            'filename' => Str::after($trace['file'], 'clone\\'),
            'line' => $trace['line'],
        ];
    }
}