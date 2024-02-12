<?php 

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