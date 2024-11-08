<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\JobName;
use App\Models\Birthday;
use Illuminate\Database\Eloquent\Builder;
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
        'favorites',
        'color',
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

    public function scopeFavorites($query)
    {
        return $query->where('favorites', true);
    }


    public function upcomingBirthdayInfo(): ?array
    {
        if (!$this->birthday || !$this->birthday->day || !$this->birthday->month) {
            return null;
        }

        $today = Carbon::today();
        $thisYearBirthday = Carbon::create($today->year, $this->birthday->month, $this->birthday->day);

        // Check if the birthday this year has passed; if so, set it to next year
        if ($thisYearBirthday->isBefore($today)) {
            $thisYearBirthday->addYear();
        }

        $daysUntilBirthday = $today->diffInDays($thisYearBirthday);

        // Only show if the birthday is within a week
        if ($daysUntilBirthday <= 7) {
            return [
                'date' => $thisYearBirthday->toFormattedDateString(),
                'days_left' => $daysUntilBirthday
            ];
        }

        return null;
    }

    public function scopeSearchContactByName(Builder $query, $searchTerm)
    {
        if ($searchTerm) {
            return $query->where(function ($q) use ($searchTerm) {
                $q->whereAny(
                    [
                        'first_name',
                        'middle_name',
                        'last_name',
                        'nickname',
                    ],
                    'LIKE',
                    '%' . $searchTerm . '%'
                )
                ->orWhereHas('phoneNumbers', function ($q) use ($searchTerm) {
                    $q->where('phone_number', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orWhereHas('emails', function ($q) use ($searchTerm) {
                    $q->where('email', 'LIKE', '%' . $searchTerm . '%');
                });
            });
        }

        return $query;
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
