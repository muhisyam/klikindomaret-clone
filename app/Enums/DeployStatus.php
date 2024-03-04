<?php 

namespace App\Enums;

enum DeployStatus: string
{
    case DRAFT = 'Draft';
    case PUBLISHED = 'Publish';
}