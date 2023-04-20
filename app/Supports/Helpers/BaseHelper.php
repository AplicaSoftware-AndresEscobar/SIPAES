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

if (!function_exists('current_user_information()')) {

    function current_user_information(): \App\Models\UserInformation
    {
        return auth('web')->user()->user_information;
    }
}

if (!function_exists('randomBoolean')) {

    function randomBoolean(): bool
    {
        return (bool) rand(0, 1);
    }
}
