<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserWorkExperiencie extends Pivot
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_work_experiencies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'company_id',
        'job_title',
        'start_date',
        'end_date',
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
     * Scope a query to only include Company
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param int|array<int,int> $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCompany($query, $value)
    {
        if (is_array($value) && $value) {
            $query->whereIn('company_id', $value);
        } else {
            $query->where('company_id', $value);
        }
    }

    /**
     * Scope a query to only include Job Title
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByJob($query, $value)
    {
        $query->where('job_title', $value);
    }

    /**
     * Get User
     * 
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get Company
     * 
     * @return BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
