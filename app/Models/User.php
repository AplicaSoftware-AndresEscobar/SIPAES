<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get Reltations on each model.
     */
    protected $with = [
        'user_information'
    ];

    /**
     * Get User Information
     * 
     * @return HasOne|UserInformation
     */
    public function user_information()
    {
        return $this->hasOne(UserInformation::class, 'user_id');
    }

    /**
     * Get User Academic Studies
     * 
     * @return BelongsToMany|Collection<EducationalInstitute>
     */
    public function academic_studies()
    {
        return $this->belongsToMany(EducationalInstitute::class, 'user_academic_studies')
            ->using(UserAcademicStudy::class)
            ->withPivot(['id', 'degree', 'year', 'academic_study_level_id'])
            ->orderByPivot('year');
    }

    /**
     * Get User Work Experiencies
     * 
     * @return BelongsToMany|Collection<Company>
     */
    public function work_experiencies()
    {
        return $this->belongsToMany(Company::class, 'user_work_experiencies')
            ->using(UserWorkExperiencie::class)
            ->withPivot(['id', 'job_title', 'start_date', 'end_date'])
            ->orderByPivot('start_date');
    }

    /**
     * Scope a query to only include Username
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByUsername($query, $value)
    {
        return $query->where("{$this->getTable()}.username", $value);
    }

    /**
     * Scope a query to only include Email
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByEmail($query, $value)
    {
        return $query->where("{$this->getTable()}.email", $value);
    }
}
