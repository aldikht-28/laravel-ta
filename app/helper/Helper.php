<?php

if (!function_exists('matauangID')) {
    function matauangID($value)
    {
        return "Rp. " . number_format($value, 0, ',', '.');
    }
}

function showDateTime($carbon, $format = "d M Y @ H:i")
{
    return $carbon->translatedFormat($format);
}
