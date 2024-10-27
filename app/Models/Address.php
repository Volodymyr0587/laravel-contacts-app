<?php

namespace App\Models;

use App\Enums\LabelType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $fillable = [
        'contact_id',
        'country_id',
        'city',
        'street',
        'building_number',
        'apartment_number',
        'label',
    ];

    protected $casts = [
        'label' => LabelType::class,
    ];

    /**
     * Get the contact that owns the Address
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * Get the country that owns the Address
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
