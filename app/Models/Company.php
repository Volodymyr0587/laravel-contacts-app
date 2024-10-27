<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    protected $fillable = [
        'contact_id',
        'name',
        'address',
    ];

    /**
     * Get the contact that owns the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * Get all of the jobsName for the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobNames(): HasMany
    {
        return $this->hasMany(JobName::class);
    }
}
