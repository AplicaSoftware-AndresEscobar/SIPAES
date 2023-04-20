<?php

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