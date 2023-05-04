<?php

if (!function_exists('optionIsSelected')) {
    /**
     * @param $ption
     * @param $value
     * 
     * @return string
     */
    function optionIsSelected($option, $value): string
    {
        return $option == $value ? 'selected' : '';
    }
}
