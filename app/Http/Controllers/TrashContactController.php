<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Gate;

class TrashContactController extends Controller
{
    public function trash()
    {
        $contacts = auth()->user()->contacts()->onlyTrashed()->paginate(5);
        return view('contacts.trash', compact('contacts'));
    }

    public function restore(Contact $contact)
    {
        Gate::authorize('editContact', $contact);

        $contact->restore();

        return redirect()->route('contacts.trash')->with('success', 'Record successfully restored');
    }

    public function restoreAll()
    {
        auth()->user()->contacts()->onlyTrashed()->restore();

        return redirect()->route('contacts.trash')->with('success', 'All records successfully restored');
    }

    public function forceDelete(Contact $contact)
    {
        Gate::authorize('editContact', $contact);

        $contact->forceDelete();

        return redirect()->route('contacts.trash')->with('success', 'Record has been permanently deleted');
    }

    public function forceDeleteAll()
    {
        // Retrieve all auth user trashed contacts
        $trashedContacts = auth()->user()->contacts()->onlyTrashed()->get();
        // Force delete each trashed contact
        foreach ($trashedContacts as $contact) {
            $contact->forceDelete();
        }

        return redirect()->route('contacts.trash')->with('success', 'All records are permanently deleted');
    }
}
