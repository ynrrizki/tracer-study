<?php

function is_route($route, $if, $else = false)
{
    return request()->routeIs($route) ? $if : ($else ?? '');
}
