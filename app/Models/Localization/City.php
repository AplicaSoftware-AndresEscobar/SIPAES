<?php

namespace App\Models\Localization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['department_id', 'name', 'slug'];

    /**
     * Get Department relationed with Department.
     * 
     * @return Department|BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

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

    /**
     * Scope a query to only include Slug.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBySlug($query, $value)
    {
        if (is_array($value) && $value) {
            return $query->whereIn("{$this->getTable()}.slug", $value);
        } else {
            return $query->where("{$this->getTable()}.slug", $value);
        }
    }
}
