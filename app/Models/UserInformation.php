<?php

namespace App\Models;

use App\Models\Localization\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserInformation extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_information';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

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
        'fullname',
        'gender_id',
        'email_fesc',
        'document',
        'document_type_id',
        'address',
        'phone',
        'telephone',
        'birthdate',
        'birthday_place_id',
    ];

    /**
     * @var array<int,string>
     */
    protected $with = [
        'gender',
        'document_type',
        'birthday_place',
    ];

    /**
     * Get User relationed with the information.
     * 
     * @return BelongsTo|User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get Gender relationed with the information.
     * 
     * @return BelongsTo|Gender
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * Get Document Type relationed with User information.
     * 
     * @return BelongsTo|DocumentType
     */
    public function document_type()
    {
        return $this->belongsTo(DocumentType::class);
    }

    /**
     * Get Birthday Place relationed with User information.
     * 
     * @return BelongsTo|City
     */
    public function birthday_place()
    {
        return $this->belongsTo(City::class, 'birthday_place_id');
    }

    /**
     * Scope a query to only include Fullname
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
     * Scope a query to only include Email Fesc
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByEmailFesc($query, $value)
    {
        return $query->where("{$this->getTable()}.email_fesc", $value);
    }

    /**
     * Scope a query to only include Document
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByDocument($query, $value)
    {
        return $query->where("{$this->getTable()}.document", $value);
    }

    /**
     * Scope a query to only include Document Type
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByDocumentType($query, $value)
    {
        if (is_array($value) && $value) {
            return $query->whereIn("{$this->getTable()}.document_type_id", $value);
        } else {
            return $query->where("{$this->getTable()}.document_type_id", $value);
        }
    }

    /**
     * Scope a query to only include Phone
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByPhone($query, $value)
    {
        return $query->where("{$this->getTable()}.phone", $value);
    }

    /**
     * Scope a query to only include Telephone
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByTelephone($query, $value)
    {
        return $query->where("{$this->getTable()}.telephone");
    }

    /**
     * Scope a query to only include Birthday Place
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByBirthdatePlace($query, $value)
    {
        if (is_array($value) && $value) {
            return $query->whereIn("{$this->getTable()}.birthday_place_id", $value);
        } else {
            return $query->where("{$this->getTable()}.birthday_place_id", $value);
        }
    }
}
