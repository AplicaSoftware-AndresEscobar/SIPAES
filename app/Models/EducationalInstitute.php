<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalInstitute extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'nit',
        'address',
        'phone',
        'telephone',
    ];

    /**
     * Get User Academic Studies
     * 
     * @return BelongsToMany|Collection<User>
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_academic_studies')
            ->using(UserAcademicStudy::class)
            ->withPivot(['name', 'year', 'academic_study_level_id']);
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
     * Scope a query to only include Email.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByEmail($query, $value)
    {
        return $query->where("{$this->getTable()}.email", "like", "%$value%");
    }

    /**
     * Scope a query to only include Nit.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByNit($query, $value)
    {
        return $query->where("{$this->getTable()}.nit", "like", "%$value%");
    }
}
