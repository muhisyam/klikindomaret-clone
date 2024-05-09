<?php 

use Carbon\Carbon;

function formatNumber($price): string 
{
    return number_format($price, 0, '.', '.');
}

function formatCurrencyIDR($price): string
{
    return number_format($price, 0, '.', '.');
}

function prettierMobileNumber($number): string
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