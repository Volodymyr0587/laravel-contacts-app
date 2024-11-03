<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Country;
use App\Enums\LabelType;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreContactRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = auth()->user()->contacts()
            ->with(['emails', 'phoneNumbers', 'jobNames'])
            ->orderByDesc('favorites')
            ->paginate(5);

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $labelTypes = LabelType::cases();
        $countries = Country::get(['id', 'name']);
        $dialCodes = Country::query()->orderBy('dial_code')->pluck('dial_code', 'id');

        session(['previous_url' => url()->previous()]);

        return view('contacts.create', compact('dialCodes', 'countries', 'labelTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        $validated = $request->validated();
        // Handle image upload
        $image = $this->handleImageUpload($request);

        try {
            // Create contact
            $contact = auth()->user()->contacts()->create([
                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'],
                'last_name' => $validated['last_name'],
                'nickname' => $validated['nickname'],
                'about' => $validated['about'],
                'image' => $image,
                'color' => $validated['color'],
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
            // Log the error for debugging
            \Log::error('Error creating contact: ' . $e->getMessage());
            return back()->with('error', 'Error creating contact: ' . $e->getMessage())
                ->withInput();
        }
    }

    protected function handleImageUpload($request)
    {
        if ($request->hasFile('image')) {
            return $request->file('image')->store('contacts', 'public');
        }

        return null;
    }

    public function toggleFavorite(Contact $contact)
    {
        Gate::authorize('editContact', $contact);

        $contact->update(['favorites' => !$contact->favorites]);

        return redirect()->back()->with('status', 'Favorite status updated');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        Gate::authorize('editContact', $contact);

        $backUrl = $this->determineBackUrl();
        return view('contacts.show', compact('contact', 'backUrl'));
    }


    /**
     *   Check if the previous URL contains the create route
     *   If it does, we redirect to the index page
     *   If not, we go back to the previous URL
     * @return string
     */
    protected function determineBackUrl()
    {
        $previousUrl = url()->previous();
        $createRoute = route('contacts.create');
        $indexRoute = route('contacts.index');

        return (strpos($previousUrl, $createRoute) !== false)
            ? $indexRoute
            : $previousUrl;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        Gate::authorize('editContact', $contact);

        $labelTypes = LabelType::cases();
        $countries = Country::get(['id', 'name']);
        $dialCodes = Country::query()->orderBy('dial_code')->pluck('dial_code', 'id');

        session(['previous_url' => url()->previous()]);

        return view('contacts.edit', compact('contact', 'dialCodes', 'countries', 'labelTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreContactRequest $request, Contact $contact)
    {
        Gate::authorize('editContact', $contact);

        $validated = $request->validated();

        // Handle image upload
        $image = $this->handleImageUpload($request);

        try {
            // Update contact details
            $contact->update([
                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'],
                'last_name' => $validated['last_name'],
                'nickname' => $validated['nickname'],
                'about' => $validated['about'],
                'image' => $image,
                'color' => $validated['color'],
            ]);

            // Update or delete existing birthday
            if (!empty($validated['birthday'])) {
                $contact->birthday()->updateOrCreate([], $validated['birthday']);
            } else {
                $contact->birthday()->delete();
            }

            // Sync emails: update existing, add new, and remove deleted
            $existingEmailIds = collect($validated['emails'])->pluck('id')->filter();
            $contact->emails()->whereNotIn('id', $existingEmailIds)->delete();
            foreach ($validated['emails'] as $emailData) {
                $contact->emails()->updateOrCreate(
                    ['id' => $emailData['id'] ?? null],
                    ['email' => $emailData['email'], 'label' => $emailData['label']]
                );
            }

            // Sync phone numbers
            $existingPhoneIds = collect($validated['phone_numbers'])->pluck('id')->filter();
            $contact->phoneNumbers()->whereNotIn('id', $existingPhoneIds)->delete();
            foreach ($validated['phone_numbers'] as $phoneData) {
                $contact->phoneNumbers()->updateOrCreate(
                    ['id' => $phoneData['id'] ?? null],
                    ['dial_code' => $phoneData['dial_code'], 'phone_number' => $phoneData['phone_number'], 'label' => $phoneData['label']]
                );
            }

            // Sync addresses
            $existingAddressIds = collect($validated['addresses'])->pluck('id')->filter();
            $contact->addresses()->whereNotIn('id', $existingAddressIds)->delete();
            foreach ($validated['addresses'] as $addressData) {
                $contact->addresses()->updateOrCreate(
                    ['id' => $addressData['id'] ?? null],
                    $addressData
                );
            }

           // Companies and jobs
            $validatedCompanies = array_filter($validated['companies'], fn($companyData) => !empty($companyData['name']));

            // Delete companies with empty names from the database
            $contact->companies()->whereNotIn('id', collect($validatedCompanies)->pluck('id')->filter())->delete();

            foreach ($validatedCompanies as $companyData) {
                $company = $contact->companies()->updateOrCreate(
                    ['id' => $companyData['id'] ?? null],
                    ['name' => $companyData['name']]
                );

                // Continue with job names as before
                $existingJobIds = collect($companyData['job_names'])->pluck('id')->filter();
                $company->jobNames()->whereNotIn('id', $existingJobIds)->delete();
                foreach ($companyData['job_names'] as $jobNameData) {
                    $company->jobNames()->updateOrCreate(
                        ['id' => $jobNameData['id'] ?? null],
                        ['title' => $jobNameData['title'], 'contact_id' => $contact->id]
                    );
                }
            }

            return redirect()->route('contacts.show', $contact)
                ->with('success', 'Contact updated successfully.');

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error updating contact: ' . $e->getMessage());
            return back()->with('error', 'Error updating contact: ' . $e->getMessage())
                ->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        Gate::authorize('editContact', $contact);

        $contact->delete();

        return to_route('contacts.index')->with('success', 'The contact has been moved to the trash');
    }
}
