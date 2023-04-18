<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

      /**
     * Scope a query to only include Name.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByName($query, $value)
    {
        if (is_array($value) && $value) {
            return $query->whereIn("{$this->getTable()}.name", $value);
        } else {
            return $query->where("{$this->getTable()}.name", $value);
        }
    }
}
