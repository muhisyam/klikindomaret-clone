<?php 

namespace App\DataTransferObjects;

class ClientRequestDto
{
    public function __construct(
        public readonly string $method,
        public readonly string $endpoint, 
        public readonly array $headers = [], 
        public readonly array $formData = [],
    ) {}
}
