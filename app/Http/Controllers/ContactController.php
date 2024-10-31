<?php

namespace App\Http\Controllers;

use App\Enums\LabelType;
use App\Models\Contact;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContactRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return auth()->user()->contacts()->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $labelTypes = LabelType::cases();
        $countries = Country::get(['id', 'name']);
        $dialCodes = Country::query()->orderBy('dial_code')->pluck('dial_code', 'id');
        return view('contacts.create', compact('dialCodes', 'countries', 'labelTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        $validated = $request->validated();

        try {
            // Create contact
            $contact = auth()->user()->contacts()->create([
                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'],
                'last_name' => $validated['last_name'],
                'nickname' => $validated['nickname'],
            ]);

            // Create birthday if provided
            if (!empty($validated['birthday'])) {
                $contact->birthday()->create($validated['birthday']);
            }

            // Create emails
            if (!empty($validated['emails'])) {
                foreach ($validated['emails'] as $emailData) {
                    $contact->emails()->create($emailData);
                }
            }

            // Create phone numbers
            if (!empty($validated['phone_numbers'])) {
                foreach ($validated['phone_numbers'] as $phoneData) {
                    $contact->phoneNumbers()->create($phoneData);
                }
            }

            // Create addresses
            if (!empty($validated['addresses'])) {
                foreach ($validated['addresses'] as $addressData) {
                    $contact->addresses()->create($addressData);
                }
            }

            // Create companies and job names
            if (!empty($validated['companies'])) {
                foreach ($validated['companies'] as $companyData) {
                    // Create a new company for the contact
                    $company = $contact->companies()->create([
                        'name' => $companyData['name'],
                    ]);
                    // Create job titles for the company
                    if (!empty($companyData['job_names'])) {
                        foreach ($companyData['job_names'] as $jobNameData) {
                            $company->jobNames()->create([
                                'title' => $jobNameData['title'],
                                'contact_id' => $contact->id,
                            ]);
                        }
                    }
                }
            }

            return redirect()->route('contacts.show', $contact)
                ->with('success', 'Contact created successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error creating contact: ' . $e->getMessage())
                ->withInput();
        }
    }




    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', $contact);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
