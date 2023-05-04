<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAcademicStudy extends Pivot
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_academic_studies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'educational_institute_id',
        'academic_study_level_id',
        'degree',
        'year',
    ];

    /**
     * Scope a query to only include Id
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param int|array<int,int> $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeById($query, $value)
    {
        if (is_array($value) && $value) {
            $query->whereIn('id', $value);
        } else {
            $query->where('id', $value);
        }
    }

    /**
     * Scope a query to only include User
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param int|array<int,int> $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByUser($query, $value)
    {
        if (is_array($value) && $value) {
            $query->whereIn('user_id', $value);
        } else {
            $query->where('user_id', $value);
        }
    }

    /**
     * Scope a query to only include Educational Institute
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param int|array<int,int> $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByEducationalInstitute($query, $value)
    {
        if (is_array($value) && $value) {
            $query->whereIn('educational_institute_id', $value);
        } else {
            $query->where('educational_institute_id', $value);
        }
    }

     /**
     * Scope a query to only include Academic Study Level
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param int|array<int,int> $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByAcademicStudyLevel($query, $value)
    {
        if (is_array($value) && $value) {
            $query->whereIn('academic_study_level_id', $value);
        } else {
            $query->where('academic_study_level_id', $value);
        }
    }

    /**
     * Scope a query to only include Degree Title
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByDegree($query, $value)
    {
        $query->where('degree', $value);
    }

     /**
     * Scope a query to only include Year Title
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByYear($query, $value)
    {
        $query->where('year', $value);
    }

    /**
     * Get Educational Institute
     * 
     * @return BelongsTo|EducationalInstitute
     */
    public function educational_institute()
    {
        return $this->belongsTo(EducationalInstitute::class);
    }

    /** 
     * Get Academic Study Level
     * 
     * @return BelongsTo|AcademicStudyLevel
     */
    public function academic_study_level()
    {
        return $this->belongsTo(AcademicStudyLevel::class);
    }
}
