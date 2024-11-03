<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Contact') }} - {{ $contact->first_name }} {{ $contact->middle_name }} {{ $contact->last_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('contacts.update', $contact) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-xl font-semibold text-gray-900">Contact</h2>
                                <p class="mt-1 text-sm/6 text-gray-600">Fill out the form with information about the contact you want to edit.</p>

                                <h3 class="mt-8 text-lg font-semibold text-gray-900">Personal information</h3>

                                <div class="mt-4 grid grid-cols-1 gap-x-2 gap-y-4 sm:grid-cols-4">

                                    <div class="sm:col-span-2">
                                        <label for="first_name"
                                            class="block text-sm/6 font-medium text-gray-900">First name *</label>
                                        <div class="mt-2">
                                            <div
                                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $contact->first_name) }}" autocomplete="first_name"
                                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6"
                                                    placeholder="First name">
                                            </div>
                                            @error('first_name')
                                            <p class="text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="middle_name"
                                            class="block text-sm/6 font-medium text-gray-900">Middle name</label>
                                        <div class="mt-2">
                                            <div
                                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $contact->middle_name) }}" autocomplete="middle_name"
                                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6"
                                                    placeholder="Middle name">
                                            </div>
                                            @error('middle_name')
                                            <p class="text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="last_name"
                                            class="block text-sm/6 font-medium text-gray-900">Last name</label>
                                        <div class="mt-2">
                                            <div
                                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $contact->last_name) }}" autocomplete="last_name"
                                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6"
                                                    placeholder="Last name">
                                            </div>
                                            @error('last_name')
                                            <p class="text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="nickname"
                                            class="block text-sm/6 font-medium text-gray-900">Nickname</label>
                                        <div class="mt-2">
                                            <div
                                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                <input type="text" name="nickname" id="nickname" value="{{ old('nickname', $contact->nickname) }}" autocomplete="nickname"
                                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6"
                                                    placeholder="Nickname">
                                            </div>
                                            @error('nickname')
                                            <p class="text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                    <div class="col-span-full">
                                        <label for="about"
                                            class="block text-sm/6 font-medium text-gray-900">About</label>
                                        <div class="mt-2">
                                            <textarea id="about" name="about" rows="3"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                                                >{{ old('about', $contact->about) }}</textarea>
                                        </div>
                                        <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about contact.
                                        </p>
                                        @error('about')
                                        <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-full">
                                        <label for="image"
                                            class="block text-sm/6 font-medium text-gray-900">Image <span class="text-xs">PNG, JPG, GIF up to 10MB</span></label>
                                        <div class="flex flex-col-1 items-center gap-x-4">
                                            @if ($contact->image)
                                            <img src="{{ asset('storage/' . $contact->image) }}" alt="{{ $contact->first_name }}"
                                                class="w-12 h-12 rounded-full">
                                            @else
                                            <div class="w-12 h-12 rounded-full flex items-center justify-center bg-gray-300 text-4xl font-bold text-white"
                                                style="background-color: {{ $contact->color }};">
                                                {{ strtoupper(substr($contact->first_name, 0, 1)) }}
                                            </div>
                                            @endif
                                            <input type="file" name="image" class="mt-2 flex items-center gap-x-3" />
                                        </div>

                                        @error('image')
                                        <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-full">
                                        <div class="flex flex-col-1 items-center gap-x-4">
                                            <label for="hs-color-input" class="block text-sm font-medium">Color</label>
                                            <input type="color" name="color" value="{{ old('color', $contact->color) }}" class="p-1 h-10 w-14 block bg-white border border-gray-200 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none" id="color" value="#2563eb" title="Choose your color">
                                        </div>

                                        @error('color')
                                        <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>

                                <h3 class="mt-8 text-base/7 font-semibold text-gray-900">Birth date</h3>
                                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-2 sm:col-start-1">
                                        <label for="birthday[day]" class="block text-sm/6 font-medium text-gray-900">Day</label>
                                        <div class="mt-2">
                                            <input type="number" name="birthday[day]" value="{{ old('birthday.day', $contact->birthday->day) }}" min="1" max="31"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="birthday[month]" class="block text-sm/6 font-medium text-gray-900">Month</label>
                                        <div class="mt-2">
                                            <input type="number" name="birthday[month]" value="{{ old('birthday.month', $contact->birthday->month) }}" min="1" max="12"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="birthday[year]" class="block text-sm/6 font-medium text-gray-900">Year</label>
                                        <div class="mt-2">
                                            <input type="number" name="birthday[year]" value="{{ old('birthday.year', $contact->birthday->year) }}" min="1900"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-b border-gray-900/10 pb-12">
                                <h3 class="text-lg font-semibold text-gray-900">Contact Information</h3>
                                <p class="mt-1 text-sm/6 text-gray-600">Fill in the fields with contact information.</p>

                                <h3 class="mt-8 text-base/7 font-semibold text-gray-900">Phone Numbers</h4>
                                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6" id="phone-section">
                                    @foreach ($contact->phoneNumbers as $index => $phoneNumber)
                                        <div class="sm:col-span-1">
                                            <label for="phone_numbers[{{ $index }}][dial_code]" class="block text-sm font-medium text-gray-900">Country code</label>
                                            <div class="mt-2">
                                                <select name="phone_numbers[{{ $index }}][dial_code]"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm">
                                                    @foreach ($dialCodes as $id => $dialCode)
                                                        <option value="{{ $dialCode }}" {{ old("phone_numbers.$index.dial_code", $phoneNumber->dial_code) == $dialCode ? 'selected' : '' }}>
                                                            {{ $dialCode }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="sm:col-span-2">
                                            <label for="phone_numbers[{{ $index }}][phone_number]" class="block text-sm font-medium text-gray-900">Phone number</label>
                                            <div class="mt-2">
                                                <input type="text" name="phone_numbers[{{ $index }}][phone_number]" value="{{ old("phone_numbers.$index.phone_number", $phoneNumber->phone_number) }}"
                                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                                                @error("phone_numbers.$index.phone_number")
                                                <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="sm:col-span-3">
                                            <label for="phone_numbers[{{ $index }}][label]" class="block text-sm font-medium text-gray-900">Label</label>
                                            <div class="flex items-center gap-x-2">
                                                <div class="mt-2">
                                                    <select name="phone_numbers[{{ $index }}][label]"
                                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm">
                                                        <option value="">Select a type</option>
                                                        @foreach ($labelTypes as $labelType)
                                                            <option value="{{ $labelType->value }}" {{ old("phone_numbers.$index.label", $phoneNumber->label) == $labelType->value ? 'selected' : '' }}>
                                                                {{ ucfirst($labelType->value) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error("phone_numbers.$index.label")
                                                    <p class="text-red-500">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <button class="mt-2 text-blue-500 hover:underline" type="button" onclick="addPhoneNumber()">Add another phone number</button>

                                <h3 class="mt-8 text-base/7 font-semibold text-gray-900">Emails</h4>
                                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6" id="email-section">
                                    @foreach ($contact->emails as $index => $email)
                                    <div class="sm:col-span-3">
                                        <label for="emails[{{ $index }}][email]" class="block text-sm/6 font-medium text-gray-900">Email</label>
                                        <div class="mt-2">
                                            <input type="email" name="emails[{{ $index }}][email]" value="{{ old("emails.$index.email", $email->email) }}"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                        </div>
                                        @error("emails.{{ $index }}.email")
                                            <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="emails[{{ $index }}][label]" class="block text-sm/6 font-medium text-gray-900">Label</label>
                                        <div class="mt-2">
                                            <select name="emails[{{ $index }}][label]" value="{{ old("emails.$index.label") }}"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                                                <option value="">Select a type</option>
                                                @foreach ($labelTypes as $labelType)
                                                <option value="{{ $labelType->value }}" {{ old("emails.$index.label")==$labelType->value ? 'selected' : ''
                                                    }}>
                                                    {{ ucfirst($labelType->value) }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <button class="mt-2 text-blue-500 hover:underline" type="button" onclick="addEmail()">Add another email</button>

                                <h3 class="mt-8 text-base/7 font-semibold text-gray-900">Addresses</h3>
                                <div class="mt-4 grid grid-cols-3 gap-x-6 gap-y-8 sm:grid-cols-6" id="address-section">
                                    @foreach ($contact->addresses as $index => $address)
                                    <div class="sm:col-span-2">
                                        <label for="addresses[{{ $index }}][country_id]"
                                            class="block text-sm/6 font-medium text-gray-900">Country</label>
                                        <div class="mt-2">
                                            <select name="addresses[{{ $index }}][country_id]"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                                                <option value="">Choose a country</option>
                                                @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ old("addresses.$index.country_id", $address->country_id ?? '') == $country->id ? 'selected' : '' }}>
                                                    {{ $country->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error("addresses.{{ $index }}.country_id")
                                            <p class="text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="addresses[{{ $index }}][city]" class="block text-sm/6 font-medium text-gray-900">City</label>
                                        <div class="mt-2">
                                            <input type="text" name="addresses[{{ $index }}][city]" value="{{ old("addresses.$index.city", $address->city ) }}"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                        </div>
                                        @error("addresses.{{ $index }}.city")
                                        <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-2">
                                        <label for="addresses[{{ $index }}][street]"
                                            class="block text-sm/6 font-medium text-gray-900">Street name</label>
                                        <div class="mt-2">
                                            <input type="text" name="addresses[{{ $index }}][street]" value="{{ old("addresses.$index.street", $address->street) }}"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                        </div>
                                        @error('addresses.{{ $index }}.street')
                                        <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- <div class="sm:col-span-2 sm:col-start-1">
                                        <label for="addresses[{{ $index }}][building_number]" class="block text-sm/6 font-medium text-gray-900">Building Number</label>
                                        <div class="mt-2">
                                            <input type="text" name="addresses[{{ $index }}][building_number]" value="{{ old('addresses.{{ $index }}.building_number', $address->building_number) }}"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                        </div>
                                        @error('addresses.{{ $index }}.building_number')
                                        <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div> --}}
                                    <div class="sm:col-span-2 sm:col-start-1">
                                        <label for="addresses[{{ $index }}][building_number]" class="block text-sm/6 font-medium text-gray-900">Building Number</label>
                                        <div class="mt-2">
                                            <input type="text" name="addresses[{{ $index }}][building_number]"
                                                   value="{{ old('addresses.' . $index . '.building_number', $address->building_number) }}"
                                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                        </div>
                                        @error("addresses.{{ $index }}.building_number")
                                            <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="sm:col-span-2">
                                        <label for="addresses[{{ $index }}][apartment_number]" class="block text-sm/6 font-medium text-gray-900">
                                            Apartment Number</label>
                                        <div class="mt-2">
                                            <input type="text" name="addresses[{{ $index }}][apartment_number]" value="{{ old('addresses.' . $index . '.apartment_number', $address->apartment_number) }}"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                        </div>
                                        @error("addresses.{{ $index }}.apartment_number")
                                        <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="addresses[{{ $index }}][label]" class="block text-sm/6 font-medium text-gray-900">Label</label>
                                        <div class="mt-2">
                                            <select name="addresses[{{ $index }}][label]" value="{{ old('addresses.' . $index . '.label', $address->label) }}"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                                                <option value="">Select a type</option>
                                                @foreach ($labelTypes as $labelType)
                                                <option value="{{ $labelType->value }}" {{ old('addresses.' . $index . '.label')==$labelType->value ? 'selected' : '' }}>
                                                    {{ ucfirst($labelType->value) }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <button class="mt-2 text-blue-500 hover:underline" type="button" onclick="addAddress()">Add another address</button>

                                <h3 class="mt-8 text-base/7 font-semibold text-gray-900">Companies / Jobs</h3>
                                <div class="mt-4 grid grid-cols-2 gap-x-6 gap-y-8 sm:grid-cols-6" id="company-section">
                                    <div class="sm:col-span-2">
                                        <label for="companies[{{ $index }}][name]"
                                            class="block text-sm/6 font-medium text-gray-900">Company name</label>
                                        <div class="mt-2">
                                            <div
                                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                <input type="text" name="companies[{{ $index }}][name]" value="{{ old('companies.' . $index . '.name') }}" autocomplete="companies[{{ $index }}][name]"
                                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6"
                                                    placeholder="FedEx">
                                            </div>
                                            @error("companies.{{ $index }}.name")
                                            <p class="text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="sm:col-span-4">
                                        <label for="companies[{{ $index }}][job_names][{{ $index }}][title]"
                                            class="block text-sm/6 font-medium text-gray-900">Job title</label>
                                        <div class="mt-2">
                                            <div
                                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                <input  type="text" name="companies[{{ $index }}][job_names][{{ $index }}][title]"
                                                value="{{ old('companies.' . $index . '.job_names.' . $index. '.title') }}"
                                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6"
                                                    placeholder="Marketer">
                                            </div>
                                            @error("companies.{{ $index }}.job_names.{{ $index }}.title")
                                            <p class="text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button class="mt-2 text-blue-500 hover:underline" type="button" onclick="addCompany()">Add another company</button>
                            </div>

                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                            <button type="submit"
                                class="px-5 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        function addPhoneNumber() {
            const phoneSection = document.getElementById('phone-section');
            const index = phoneSection.children.length;

            phoneSection.insertAdjacentHTML('beforebegin', `
            <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6" id="phone-section">
                <div class="sm:col-span-1">
                    <label for="phone_numbers[${index}][dial_code]" class="block text-sm/6 font-medium text-gray-900">Country code</label>
                    <div class="mt-2">
                        <select name="phone_numbers[${index}][dial_code]"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                            @foreach ($dialCodes as $id => $dialCode)
                            <option value="{{ $dialCode }}" {{ old('phone_numbers.${index}.dial_code')==$dialCode ? 'selected' : '' }}>
                            {{ $dialCode }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="phone_numbers[${index}][phone_number]" class="block text-sm/6 font-medium text-gray-900">Phone number</label>
                    <div class="mt-2">
                        <input type="text" name="phone_numbers[${index}][phone_number]" value="{{ old('phone_numbers.${index}.phone_number') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                            @error('phone_numbers.${index}.phone_number')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="phone_numbers[${index}][label]" class="block text-sm/6 font-medium text-gray-900">Label</label>
                    <div class="mt-2">
                        <select name="phone_numbers[${index}][label]"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                        <option value="">Select a type</option>
                        @foreach ($labelTypes as $labelType)
                        <option value="{{ $labelType->value }}" {{ old('phone_numbers.${index}.label')==$labelType->value ?
                            'selected' : '' }}>
                            {{ ucfirst($labelType->value) }}
                        </option>
                        @endforeach
                        </select>
                        @error('phone_numbers.${index}.label')
                        <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            `);
        }

        function addEmail() {
            const emailSection = document.getElementById('email-section');
            const index = emailSection.children.length;

            emailSection.insertAdjacentHTML('afterend', `
            <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="emails[${index}][email]" class="block text-sm/6 font-medium text-gray-900">Email</label>
                    <div class="mt-2">
                        <input type="email" name="emails[${index}][email]" value="{{ old('emails.${index}.email') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                    </div>
                    @error('emails.${index}.email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="sm:col-span-2">
                    <label for="emails[${index}][label]" class="block text-sm/6 font-medium text-gray-900">Label</label>
                    <div class="mt-2">
                        <select name="emails[${index}][label]" value="{{ old('emails.${index}.label') }}"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                            <option value="">Select a type</option>
                            @foreach ($labelTypes as $labelType)
                            <option value="{{ $labelType->value }}" {{ old('emails.${index}.label')==$labelType->value ? 'selected' : ''
                                }}>
                                {{ ucfirst($labelType->value) }}
                            </option>
                            @endforeach
                        </select>
                        @error('emails.${index}.label')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            `);
        }

        function addAddress() {
            const addressSection = document.getElementById('address-section');
            const index = addressSection.children.length;
            // Render label options using the enum
            const labelOptions = `
                <option value="">Select a type</option>
                @foreach ($labelTypes as $labelType)
                    <option value="{{ $labelType->value }}">{{ ucfirst($labelType->value) }}</option>
                @endforeach
            `;
            // Render country options using the provided list of countries
            const countryOptions = `
                <option value="">Choose a country</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            `;
            // Insert new address fields
            addressSection.insertAdjacentHTML('afterend', `
                <div class="mt-4 grid grid-cols-3 gap-x-6 gap-y-8 sm:grid-cols-6" id="address-section">
                <div class="sm:col-span-2">
                    <label for="addresses[${index}][country_id]"
                        class="block text-sm/6 font-medium text-gray-900">Country</label>
                    <div class="mt-2">
                        <select name="addresses[${index}][country_id]"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                            <option value="">Choose a country</option>
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}" {{ old('addresses.0.country_id')==$country->id ?
                                'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('addresses.${index}.country_id')
                        <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="addresses[${index}][city]" class="block text-sm/6 font-medium text-gray-900">City</label>
                    <div class="mt-2">
                        <input type="text" name="addresses[${index}][city]" value="{{ old('addresses.${index}.city') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                    </div>
                    @error('addresses.${index}.city')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-2">
                    <label for="addresses[${index}][street]"
                        class="block text-sm/6 font-medium text-gray-900">Street name</label>
                    <div class="mt-2">
                        <input type="text" name="addresses[${index}][street]" value="{{ old('addresses.${index}.street') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                    </div>
                    @error('addresses.${index}.street')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2 sm:col-start-1">
                    <label for="addresses[${index}][building_number]" class="block text-sm/6 font-medium text-gray-900">Building Number</label>
                    <div class="mt-2">
                        <input type="text" name="addresses[${index}][building_number]" value="{{ old('addresses.${index}.building_number') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                    </div>
                    @error('addresses.${index}.building_number')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="addresses[${index}][apartment_number]" class="block text-sm/6 font-medium text-gray-900">
                        Apartment Number</label>
                    <div class="mt-2">
                        <input type="text" name="addresses[${index}][apartment_number]" value="{{ old('addresses.${index}.apartment_number') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                    </div>
                    @error('addresses.${index}.apartment_number')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="addresses[${index}][label]" class="block text-sm/6 font-medium text-gray-900">Label</label>
                    <div class="mt-2">
                        <select name="addresses[${index}][label]" value="{{ old('addresses.${index}.label') }}"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                            <option value="">Select a type</option>
                            @foreach ($labelTypes as $labelType)
                            <option value="{{ $labelType->value }}" {{ old('addresses.0.label')==$labelType->value ? 'selected' :
                                '' }}>
                                {{ ucfirst($labelType->value) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            `);
        }

        function addCompany() {
            const companySection = document.getElementById('company-section');
            const index = companySection.children.length / 2; // Divide by 2 because each company has two columns (Company name and Job title)

            companySection.insertAdjacentHTML('beforeend', `
                <div class="sm:col-span-2 mt-4">
                    <label for="companies[${index}][name]" class="block text-sm/6 font-medium text-gray-900">Company name</label>
                    <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="text" name="companies[${index}][name]" value="{{ old('companies.${index}.name') }}" autocomplete="companies[${index}][name]"
                                class="block flex-1 border-0 bg-transparent py-1.5 pl-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6"
                                placeholder="FedEx">
                        </div>
                        @error('companies.${index}.name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="sm:col-span-4 mt-4">
                    <label for="companies[${index}][job_names][0][title]" class="block text-sm/6 font-medium text-gray-900">Job title</label>
                    <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="text" name="companies[${index}][job_names][0][title]" value="{{ old('companies.${index}.job_names.0.title') }}"
                                class="block flex-1 border-0 bg-transparent py-1.5 pl-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6"
                                placeholder="Marketer">
                        </div>
                        @error('companies.${index}.job_names.0.title')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            `);
        }
    </script>
</x-app-layout>
