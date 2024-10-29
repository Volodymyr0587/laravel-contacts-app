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
    // public function store(StoreContactRequest $request)
    // {
    //     $validated = $request->validated();

    //     // dd($validated);

    //     try {
    //         DB::beginTransaction();

    //         // Create contact
    //         $contact = auth()->user()->contacts()->create([
    //             'first_name' => $validated['first_name'],
    //             'middle_name' => $validated['middle_name'],
    //             'last_name' => $validated['last_name'],
    //             'nickname' => $validated['nickname'],
    //         ]);

    //         // Create birthday if provided
    //         if (isset($validated['birthday']) && isset($validated['birthday']['month'])) {
    //             $contact->birthday()->create([
    //                 'day' => $validated['birthday']['day'],
    //                 'month' => $validated['birthday']['month'],
    //                 'year' => $validated['birthday']['year'] ?? null,
    //             ]);
    //         }

    //         // Create emails
    //         if (isset($validated['emails'])) {
    //             foreach ($validated['emails'] as $emailData) {
    //                 $contact->emails()->create([
    //                     'email' => $emailData['email'],
    //                     'label' => $emailData['label'],
    //                 ]);
    //             }
    //         }

    //         // Create phone numbers
    //         if (isset($validated['phone_numbers'])) {
    //             foreach ($validated['phone_numbers'] as $phoneData) {
    //                 $contact->phoneNumbers()->create([
    //                     'country_code' => $phoneData['country_code'],
    //                     'phone_number' => $phoneData['phone_number'],
    //                     'label' => $phoneData['label'],
    //                 ]);
    //             }
    //         }

    //         // Create addresses
    //         if (isset($validated['addresses'])) {
    //             foreach ($validated['addresses'] as $addressData) {
    //                 $contact->addresses()->create([
    //                     'country_id' => $addressData['country_id'],
    //                     'city' => $addressData['city'],
    //                     'street' => $addressData['street'],
    //                     'building_number' => $addressData['building_number'],
    //                     'apartment_number' => $addressData['apartment_number'],
    //                     'label' => $addressData['label'],
    //                 ]);
    //             }
    //         }

    //         // Create companies and job_names
    //         if (isset($validated['companies'])) {
    //             foreach ($validated['companies'] as $companyData) {
    //                 $company = $contact->companies()->create([
    //                     'name' => $companyData['name'],
    //                     'address' => $companyData['address'],
    //                 ]);

    //                 // If there are job_names for this company
    //                 if (isset($validated['job_names'])) {
    //                     foreach ($validated['job_names'] as $jobData) {
    //                         if ($jobData['company_id'] == $company->id) {
    //                             $contact->jobNames()->create([
    //                                 'company_id' => $company->id,
    //                                 'title' => $jobData['title'],
    //                             ]);
    //                         }
    //                     }
    //                 }
    //             }
    //         }

    //         DB::commit();

    //         return redirect()->route('contacts.show', $contact)
    //             ->with('success', 'Contact created successfully.');

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return back()->with('error', 'Error creating contact: ' . $e->getMessage())
    //             ->withInput();
    //     }
    // }

    public function store(StoreContactRequest $request)
    {
        $validated = $request->validated();
        // dd($validated);

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

            // Create companies
            // if (!empty($validated['companies'])) {
            //     foreach ($validated['companies'] as $companyData) {
            //         $contact->companies()->create($companyData);
            //     }
            // }

            // // Create job names (assign to the contact, not company)
            // if (!empty($validated['job_names'])) {
            //     foreach ($validated['job_names'] as $jobData) {
            //         $contact->jobNames()->create($jobData);
            //     }
            // }

            // Create companies and job names
            // if (!empty($validated['companies'])) {
            //     foreach ($validated['companies'] as $companyData) {
            //         // Створення компанії
            //         $company = $contact->companies()->create([
            //             'name' => $companyData['name'],
            //             'address' => $companyData['address'] ?? null,
            //         ]);

            //         // Створення job titles для цієї компанії
            //         if (!empty($companyData['job_names'])) {
            //             foreach ($companyData['job_names'] as $jobData) {
            //                 $company->jobNames()->create([
            //                     'title' => $jobData['title'],
            //                 ]);
            //             }
            //         }
            //     }
            // }

            // Створення компаній і job names
            // if (!empty($validated['companies'])) {

            //     foreach ($validated['companies'] as $companyData) {
            //         // Створення компанії
            //         $company = $contact->companies()->create([
            //             'name' => $companyData['name'],
            //             'address' => $companyData['address'] ?? null,
            //         ]);

            //         // Логування створеної компанії
            //         \Log::info('Created company:', $company->toArray());

            //         // Створення job titles для цієї компанії
            //         if (!empty($companyData['job_names'])) {
            //             foreach ($companyData['job_names'] as $jobData) {
            //                 $company->jobNames()->create([
            //                     'title' => $jobData['title'],
            //                 ]);

            //                 // Логування створених job titles
            //                 \Log::info('Created job title:', ['title' => $jobData['title'], 'company_id' => $company->id]);
            //             }
            //         }
            //     }
            // }

            // Створення компаній та job names
            if (!empty($validated['companies'])) {
                foreach ($validated['companies'] as $companyData) {
                    // Створення компанії
                    $company = $contact->companies()->create([
                        'name' => $companyData['name'],
                    ]);

                    // Логування створеної компанії
                    // \Log::info('Created company:', $company->toArray());

                    // Створення job titles для цієї компанії
                    if (!empty($companyData['job_names'])) {
                        foreach ($companyData['job_names'] as $jobName) {
                            $company->jobNames()->create($jobName);

                            // Логування створених job titles
                            // \Log::info('Created job title:', ['title' => $jobData['title'], 'company_id' => $company->id]);
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
