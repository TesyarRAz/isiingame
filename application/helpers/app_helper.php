<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('uri_is')) {
    function uri_is(...$patterns)
    {
        foreach ($patterns as $pattern) {
            if (fnmatch($pattern, uri_string())) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('number_ukuran')) {
    function number_ukuran($mb)
    {
        return $mb > 1000 ? $mb / 1000 : $mb;
    }
}

if (!function_exists('label_ukuran')) {
    function label_ukuran($mb)
    {
        return $mb > 1000 ? 'GB' : 'MB';
    }
}

if (!function_exists('ukuran_format')) {
    function ukuran_format($mb)
    {
        return number_format(number_ukuran($mb), 0, ',', '.') . ' ' . label_ukuran($mb);
    }
}