<?php 

use Carbon\Carbon;

function formatNumber($price) 
{
    return number_format($price, 0, '.', '.');
}

function formatCurrencyIDR($price) 
{
    return number_format($price, 0, '.', '.');
}

function prettierMobileNumber($number)
{
    $number = substr($number, 1);

    $prettierNumber = '+62 ' . substr_replace($number, '-', 3, 0);
    $prettierNumber = substr_replace($prettierNumber, '-', 12, 0);

    return $prettierNumber;
}

function formatFullname(string $fullname): string
{
    $countName = str_word_count($fullname, 1);
    $abbreviatingFirstName = $countName[0][0];
    $formatedFullname = $abbreviatingFirstName . ' ' . end($countName); 

    return $formatedFullname;
}

function formatToIdnLocale(Carbon $datetime, string $formatDate = ''): string
{
    return $datetime->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format($formatDate);
}