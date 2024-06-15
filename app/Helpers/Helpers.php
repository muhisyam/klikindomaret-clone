<?php 

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

// MARK: Format Number. 
/**
 * Adding '.' separator for thousands
*/
function formatNumber($price): string 
{
    return number_format($price, 0, '.', '.');
}

// MARK: Format price number to idr format. 
/**
 * Format price number to Rp #.###.
*/
function formatCurrencyIDR($price): string
{
    return 'Rp ' . number_format($price, 0, '.', '.');
}

// MARK: Prettier mobile number. 
/**
 * Format string mobile phone to +62 ###-####-####.
*/
function prettierMobileNumber($mobileNumber): string
{
    $mobileNumber   = substr($mobileNumber, 1);
    $prettierNumber = '+62 ' . substr_replace($mobileNumber, '-', 3, 0);
    $prettierNumber = substr_replace($prettierNumber, '-', 12, 0);

    return $prettierNumber;
}

// MARK: Format fullname. 
/**
 * Abbreviating user fullname.
 * 
 * @param string $fullname
*/
function formatFullname(string $fullname): string
{
    $countName             = str_word_count($fullname, 1);
    $abbreviatingFirstName = $countName[0][0];
    $formatedFullname      = $abbreviatingFirstName . ' ' . end($countName); 

    return $formatedFullname;
}

// MARK: Carbon to IDN locale. 
/**
 * Get carbon IDN locale with format date.
 * 
 * @param \Carbon\Carbon $datetime
 * @param string         $formatDate
*/
function formatToIdnLocale(Carbon $datetime, string $formatDate = ''): string
{
    return $datetime->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format($formatDate);
}

// MARK: Carbon parse.
/**
 * Parse string date to carbon instance.
 * 
 * @param string $date
 * @param string $separator
*/
function parseToCarbon(string $date, string $separator = ' '): Carbon 
{
    if (str_contains($date, '|')) {
        $date = explode('|', $date)[0];
    }

    $monthInt = [
        'Januari'   => 1, 'Februari' => 2,  'Maret'    => 3,  'April'    => 4, 
        'Mei'       => 5, 'Juni'     => 6,  'Juli'     => 7,  'Agustus'  => 8, 
        'September' => 9, 'Oktober'  => 10, 'November' => 11, 'Desember' => 12
    ];

    $arrDate = explode($separator, $date);

    return Carbon::create($arrDate[2], $monthInt[$arrDate[1]], $arrDate[0]);
}

// MARK: Notification greets.
/**
 * Create greet text in notification.
*/
function createGreeting(): string
{
    $formateHtml = '<span>%s</span>, <span class="italic font-bold">%s!</span>';
    $username    = formatFullname(getAuthFullname()) ;
    $currentHour = now()->format('H');

    if ($currentHour >= 5 && $currentHour < 12) {
        $greetDay = 'Selamat Pagi';
    } elseif ($currentHour >= 12 && $currentHour < 15) {
        $greetDay = 'Selamat Siang';
    } elseif ($currentHour >= 15 && $currentHour < 18) {
        $greetDay = 'Selamat Sore';
    } else {
        $greetDay = 'Selamat Malam';
    }

    return sprintf($formateHtml, $greetDay, $username);
}

// MARK: Slug to Title case.
/**
 * Convert slug case to title case.
 * 
 * @param string $slug
*/
function slugToTitle(string $slug): string
{
    $title = str_replace('-', ' ', $slug);
    $title = ucwords($title);
    
    return $title;
}

// MARK: Slug to Title case.
/**
 * Prettier array attribute name.
 * 
 * @param string $attributeName The attribute that want to prettier
 * @param bool   $ucfirst       First result word will be uppercase
*/
function prettierAttr(string $attributeName, bool $ucfirst = true): string
{
    $exploded  = explode('.', $attributeName);
    $attrName  = $exploded[0];
    $attrIndex = ++$exploded[1];
    $pretty    = str_replace('_', ' ', $attrName);
    $ucAttr    = $ucfirst ? ucfirst($pretty) : $pretty;
    $result    = $ucAttr . ' ' .  $attrIndex;
    
    return $result;
}

// MARK: Trim text.
/**
 * Trim text after specified word.
 * 
 * @param string $text    The text that want to trimmed
 * @param string $offset  The needle used to locate the starting point for trimming
 * @param bool   $ucfirst First result word will be uppercase
*/
function trimText(string $text, string $offset, bool $ucfirst = true): string
{
    $position  = strpos($text, $offset);
    $substring = substr($text, $position + strlen($offset));
    $trimmed   = trim($substring);
    $result    = $ucfirst ? ucfirst($trimmed) : $trimmed;
    
    return $result;
}

// MARK: Check current route.
/**
 * Checks if the current route contains the specified key URL.
 * 
 * @param string $keyUrl The URL key to check against the current route.
*/
function isRouteContains(string $keyUrl): bool
{
    $ensureNotInLivewireUpdateComponent = ! str_contains(url()->current(), 'livewire/update');
    $allowedRoutesAfterUpdateComponent  = [
        'edit',
    ];

    if ($ensureNotInLivewireUpdateComponent) {
        return str_contains(Route::currentRouteAction(), $keyUrl);
    }
    
    if (in_array($keyUrl, $allowedRoutesAfterUpdateComponent)) {
        return true;
    }

    return false;
}

// MARK: Check error key exist.
/**
 * Check if a specific error key exists in the given error array.
 *
 * @param null|array $error The error array to search.
 * @param string     $field The error key to search for.
*/
function checkErrorKeyExist(null|array $error, string $field): bool|array
{
    if (is_null($error) || empty($error['errors'])) {
        return false;
    }

    return preg_grep('/^' . $field . '\./', array_keys($error['errors']));
}