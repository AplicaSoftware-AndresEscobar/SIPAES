<?php

use Carbon\Carbon;

if (!function_exists('getModelAttribute')) {
    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * 
     * @return string
     */
    function getModelAttribute($model, $attribute): string
    {
        return !is_null($model) && $model->$attribute ? $model->$attribute : 'Sin registro';
    }
}

if (!function_exists('diffBetweenTwoDates')) {
    /**
     * @param string $firstDate
     * @param string $secondDate
     * @return string
     */
    function diffBetweenTwoDates($firstDate, $secondDate)
    {
        $dateOne = Carbon::parse($firstDate);
        $dateTwo = Carbon::parse($secondDate);

        $count = $dateOne->diffInYears($dateTwo);
        $text = $count > 1 ? 'años' : 'año';
        return "$count $text";
    }
}
