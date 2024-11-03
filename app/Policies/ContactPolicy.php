<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;

class ContactPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function editContact(User $user, Contact $contact): bool
    {
        return $contact->user()->is($user);
    }

}
