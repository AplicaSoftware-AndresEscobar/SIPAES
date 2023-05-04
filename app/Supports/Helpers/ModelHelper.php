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

        $diff = $dateOne->diff($dateTwo);

        $year = $diff->y;
        $month = $diff->m;
        $day = $diff->d;
        $array = [
            [
                'value' => $year,
                'single' => 'año',
                'multiple' => 'años',
            ],
            [
                'value' => $month,
                'single' => 'mes',
                'multiple' => 'meses',
            ],
            [
                'value' => $day,
                'single' => 'día',
                'multiple' => 'días',
            ]
        ];
        $text = '';

        foreach ($array as $index => $item) {
            $value = $item['value'];
            if (!$value == 0) {
                $type = ($value > 1) ? $item['multiple'] : $item['single'];
                $text .= "$value $type ";
            }
        }

        return $text;
    }
}
