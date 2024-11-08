<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ExportContactsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Retrieve contacts with phones and emails for the authenticated user
        $contacts = auth()->user()
            ->contacts()->with(['phoneNumbers', 'emails', 'addresses.country']) // Eager-load the country relation
            ->get();

        // Format the current date and time
        $timestamp = Carbon::now()->format('Y_m_d_His');
        $filename = "contacts_{$timestamp}.csv";

        return response()->streamDownload(function () use ($contacts) {
            $file = fopen('php://output', 'w');

            // Write the CSV header row
            fputcsv($file, ['Name', 'Phones', 'Emails', 'Addresses']);

            foreach ($contacts as $contact) {
                // Join multiple phone numbers, emails and addresses as coma-separated strings

                // Format phone numbers with all fields
                $phones = $contact->phoneNumbers->map(function ($phone) {
                    return implode(', ', [
                        "$phone->dial_code $phone->phone_number",
                        "Label: " . ucfirst($phone->label->value),
                    ]);
                })->join(' || '); // Separate each phone entry with ' | '

                // Format emails with all fields
                $emails = $contact->emails->map(function ($email) {
                    return implode(', ', [
                        $email->email,
                        "Label: " . ucfirst($email->label->value),
                    ]);
                })->join(' || '); // Separate each email entry with ' | '

                // Format each address with all fields and include the country name
                $addresses = $contact->addresses->map(function ($address) {
                    return implode(', ', [
                        "Country: " . ($address->country->name ?? 'N/A'),  // Get country name or 'N/A' if null
                        "City: " . $address->city,
                        "Street: " . $address->street,
                        "Building: " . $address->building_number,
                        "Apartment: " . $address->apartment_number,
                        "Label: " . ucfirst($address->label->value)
                    ]);
                })->join(' || '); // Separate each address with ' | '
                // Write each contact's data into row
                fputcsv($file, [
                    "$contact->first_name $contact->middle_name $contact->last_name $contact->nickname",
                    $phones,
                    $emails,
                    $addresses,
                ]);
            }

            fclose($file);
        }, $filename, ['Content-Type' => 'text/csv']);
    }
}
