<?php

if (!function_exists('isProductionEnv')) {
    function isProductionEnv(): bool
    {
        return config('app.env') == 'production';
    }
}

if (!function_exists('current_user')) {

    function current_user(): \App\Models\User
    {
        return auth('web')->user();
    }
}
