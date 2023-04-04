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
