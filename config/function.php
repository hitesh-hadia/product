<?php

function getCurrencyFormated($amount = 0)
{
    return '₹'.number_format((float)$amount, 2, '.', '');
}