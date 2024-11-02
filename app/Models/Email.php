<?php

namespace App\Models;

use App\Enums\LabelType;
use App\Observers\EmailObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Email extends Model
{
    protected $fillable = [
        'contact_id',
        'email',
        'label',
    ];

    protected $casts = [
        'label' => LabelType::class,
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public static function boot()
    {
        parent::boot();

        static::observe(EmailObserver::class);
    }
}
