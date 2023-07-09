<?php

use Carbon\Carbon;

function is_route($route, $if, $else = false)
{
    return request()->routeIs($route) ? $if : ($else ?? '');
}

function carbon()
{
    return new Carbon();
}


if (!function_exists('is_admin')) {
    function is_admin()
    {
        return auth()->user()->role == 'ADMIN';
    }
}


if (!function_exists('is_alumni')) {
    function is_alumni()
    {
        return auth()->user()->role == 'ALUMNI';
    }
}
