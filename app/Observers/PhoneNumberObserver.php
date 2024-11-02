<?php

namespace App\Observers;

use App\Models\PhoneNumber;

class PhoneNumberObserver
{
    /**
     * Handle the PhoneNumber "created" event.
     */
    public function created(PhoneNumber $phoneNumber): void
    {
        //
    }

    /**
     * Handle the PhoneNumber "updated" event.
     */
    public function updated(PhoneNumber $phoneNumber): void
    {
        //
    }

    /**
     * Handle the PhoneNumber "deleted" event.
     */
    public function deleted(PhoneNumber $phoneNumber): void
    {
        //
    }

    /**
     * Handle the PhoneNumber "restored" event.
     */
    public function restored(PhoneNumber $phoneNumber): void
    {
        //
    }

    /**
     * Handle the PhoneNumber "force deleted" event.
     */
    public function forceDeleted(PhoneNumber $phoneNumber): void
    {
        //
    }

    public function saving(PhoneNumber $phoneNumber)
    {
        if (empty($phoneNumber->phone_number)) {
            return false; // Prevent saving empty number
        }
    }

    public function updating(PhoneNumber $phoneNumber)
    {
        if (empty($phoneNumber->phone_number)) {
            return false; // Prevent saving empty number
        }
    }
}
