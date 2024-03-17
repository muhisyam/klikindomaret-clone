<?php 

namespace App\Enums;

enum DeployStatus: string
{
    case DRAFT = 'Draft';
    case PUBLISHED = 'Publish';
    case EXPIRED = 'Expired';

    protected static function getStyleColor($label): string
    {
        return match($label){
            self::DRAFT->value => 'bg-gray-100 text-gray-700', 
            self::PUBLISHED->value => 'bg-green-100 text-green-700', 
            self::EXPIRED->value => 'bg-red-100 text-red-700', 
        };
    }

    public static function getStyle($label): string
    {
        $html = '<div class="mx-auto rounded-md p-1 w-20 font-bold text-center %s">%s</div>';

        return sprintf($html, self::getStyleColor($label), $label);
    }
}