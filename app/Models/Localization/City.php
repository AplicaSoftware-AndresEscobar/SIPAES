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
    protected $fillable = ['department_id', 'name'];

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
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByName($query, $value)
    {
        return $query->where("{$this->getTable()}.name", "like", "%$value%");
    }

    /**
     * Get Location with City, Department and Country
     * 
     * @return string
     */
    public function getLocation()
    {
        /** @var department $deparment */
        $deparment = $this->department;

        /** @var Country $country */
        $country = $deparment->country;

        return "{$this->name}, {$deparment->name}, {$country->name}.";
    }
}
