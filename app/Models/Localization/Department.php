<?php

namespace App\Models\Localization;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['country_id', 'name'];

    /**
     * Get Country relationed with Department.
     * 
     * @return Country|BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get Cities relationed with Department.
     * 
     * @return Collection<City>|HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class);
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
}
