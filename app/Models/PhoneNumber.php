<?php

namespace App\Models;

use App\Enums\LabelType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhoneNumber extends Model
{
    protected $fillable = [
        'contact_id',
        'code',
        'phone_number',
        'label',
    ];

    protected $casts = [
        'label' => LabelType::class,
    ];

    /**
     * Get the contact that owns the PhoneNumber
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * Get the country that owns the PhoneNumber
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'code');
    }
}
