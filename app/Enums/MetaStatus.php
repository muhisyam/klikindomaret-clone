<?php 

namespace App\Enums;

abstract class MetaStatus
{
    const OK = [
        'status_code' => 200,
        'message'     => 'OK',
    ];

    const CREATED = [
        'status_code' => 201,
        'message'     => 'Created',
    ];

    public static function get($status): array
    {
        $dataMeta = match ($status) {
            'OK'      => self::OK,
            'CREATED' => self::CREATED,
        };

        return ['meta' => $dataMeta];
    }
}