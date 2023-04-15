<?php

if (!function_exists('current_user')) {

    function current_user(): \App\Models\User
    {
        return auth('web')->user();
    }
}
