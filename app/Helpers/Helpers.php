<?php 

function formatCurrencyIDR($price) 
{
    return number_format($price, 0, '.', '.');
}