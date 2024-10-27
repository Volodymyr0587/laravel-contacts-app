<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Birthday extends Model
{
    protected $fillable = [
        'contact_id',
        'day',
        'month',
        'year',
    ];

    /**
     * Get the contact that owns the Birthday
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
