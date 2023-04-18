<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'educational_institute_id',
        'academic_study_level_id',
        'name',
        'year',
    ];

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
