<?php

namespace App\Models;

use App\Models\JobName;
use App\Models\Birthday;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'nickname',
        'about',
        'image',
    ];

    /**
     * Get the user who owns the Contact
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the emails associated with the Contact
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emails(): HasMany
    {
        return $this->hasMany(Email::class);
    }

    /**
     * Get the phoneNumbers associated with the Contact
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phoneNumbers(): HasMany
    {
        return $this->hasMany(PhoneNumber::class);
    }

    /**
     * Get the addresses associated with the Contact
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Get the birthday associated with the Contact
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function birthday(): HasOne
    {
        return $this->hasOne(Birthday::class);
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    /**
     * Get all of the jobs for the Contact
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobNames(): HasMany
    {
        return $this->hasMany(JobName::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($contact) {
            if (request()->hasFile('image')) {
                if ($contact->getOriginal('image')) {
                    Storage::disk('public')->delete($contact->getOriginal('image'));
                }
            }
        });

        static::forceDeleting(function ($contact) {
            if ($contact->image) {
                Storage::disk('public')->delete($contact->image);
            }
        });
    }
}
