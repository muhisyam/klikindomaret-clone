<?php 

namespace App\DataTransferObjects;

use Illuminate\Database\Eloquent\Model;

class FindDataDto
{
    public function __construct(
        public readonly Model $model,
        public readonly array $whereSchema = [], 
        public readonly array $withSchema = [], 
        public readonly array $withCountSchema = [],
    ) {}
}
