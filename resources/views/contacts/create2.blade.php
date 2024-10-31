<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Contact') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('contacts.store') }}" method="POST">
                        @csrf
                        <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-xl font-semibold text-gray-900">Contact</h2>
                                <p class="mt-1 text-sm/6 text-gray-600">Fill out the form with information about the contact you want to save.</p>

                                <h3 class="mt-8 text-lg font-semibold text-gray-900">Personal information</h3>

                                <div class="mt-4 grid grid-cols-1 gap-x-2 gap-y-4 sm:grid-cols-4">

                                    <div class="sm:col-span-2">
                                        <label for="first_name"
                                            class="block text-sm/6 font-medium text-gray-900">First name *</label>
                                        <div class="mt-2">
                                            <div
                                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" autocomplete="first_name"
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
                                                <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name') }}" autocomplete="middle_name"
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
                                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" autocomplete="last_name"
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
                                                <input type="text" name="nickname" id="nickname" value="{{ old('nickname') }}" autocomplete="nickname"
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
                                                >{{ old('about') }}</textarea>
                                        </div>
                                        <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about contact.
                                        </p>
                                        @error('about')
                                        <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-full">
                                        <label for="photo"
                                            class="block text-sm/6 font-medium text-gray-900">Photo <span class="text-xs">PNG, JPG, GIF up to 10MB</span></label>
                                        <div class="flex flex-col-1 items-center gap-x-4">
                                            <svg class="h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                                aria-hidden="true" data-slot="icon">
                                                <path fill-rule="evenodd"
                                                    d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <input type="file" name="photo" class="mt-2 flex items-center gap-x-3" />
                                        </div>


                                            {{-- <button type="button"
                                                class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Upload</button> --}}

                                        @error('photo')
                                        <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- <div class="sm:col-span-3">
                                        <label for="country"
                                            class="block text-sm/6 font-medium text-gray-900">Country</label>
                                        <div class="mt-2">
                                            <select id="country" name="country" autocomplete="country-name"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                                                <option>United States</option>
                                                <option>Canada</option>
                                                <option>Mexico</option>
                                            </select>
                                        </div>
                                    </div> --}}



                                </div>

                                <h3 class="mt-8 text-base/7 font-semibold text-gray-900">Birth date</h3>
                                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-2 sm:col-start-1">
                                        <label for="birthday[day]" class="block text-sm/6 font-medium text-gray-900">Day</label>
                                        <div class="mt-2">
                                            <input type="number" name="birthday[day]" value="{{ old('birthday.day') }}" min="1" max="31"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="birthday[month]" class="block text-sm/6 font-medium text-gray-900">Month</label>
                                        <div class="mt-2">
                                            <input type="number" name="birthday[month]" value="{{ old('birthday.month') }}" min="1" max="12"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="birthday[year]" class="block text-sm/6 font-medium text-gray-900">Year</label>
                                        <div class="mt-2">
                                            <input type="number" name="birthday[year]" value="{{ old('birthday.year') }}" min="1900"
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
                                    <div class="sm:col-span-1">
                                        <label for="first-name" class="block text-sm/6 font-medium text-gray-900">Country code</label>
                                        <div class="mt-2">
                                            <select name="phone_numbers[0][dial_code]"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                                                @foreach ($dialCodes as $id => $dialCode)
                                                <option value="{{ $dialCode }}" {{ old('phone_numbers.0.dial_code')==$dialCode ? 'selected' : '' }}>
                                                {{ $dialCode }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Phone number</label>
                                        <div class="mt-2">
                                            <input type="text" name="phone_numbers[0][phone_number]" value="{{ old('phone_numbers.0.phone_number') }}"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                                @error('phone_numbers.0.phone_number')
                                                <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Label</label>
                                        <div class="mt-2">
                                            <select name="phone_numbers[0][label]"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                                            <option value="">Select a type</option>
                                            @foreach ($labelTypes as $labelType)
                                            <option value="{{ $labelType->value }}" {{ old('phone_numbers.0.label')==$labelType->value ?
                                                'selected' : '' }}>
                                                {{ ucfirst($labelType->value) }}
                                            </option>
                                            @endforeach
                                            </select>
                                            @error('phone_numbers.0.label')
                                            <p class="text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button class="mt-2 text-blue-500 hover:underline" type="button" onclick="addPhoneNumber()">Add another phone number</button>

                                <h3 class="mt-8 text-base/7 font-semibold text-gray-900">Emails</h4>
                                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6" id="email-section">
                                    <div class="sm:col-span-3">
                                        <label for="emails[0][email]" class="block text-sm/6 font-medium text-gray-900">Email</label>
                                        <div class="mt-2">
                                            <input type="email" name="emails[0][email]" value="{{ old('emails.0.email') }}"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                        </div>
                                        @error('emails.0.email')
                                            <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Label</label>
                                        <div class="mt-2">
                                            <select name="emails[0][label]" value="{{ old('emails.0.label') }}"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                                                <option value="">Select a type</option>
                                                @foreach ($labelTypes as $labelType)
                                                <option value="{{ $labelType->value }}" {{ old('emails.0.label')==$labelType->value ? 'selected' : ''
                                                    }}>
                                                    {{ ucfirst($labelType->value) }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <button class="mt-2 text-blue-500 hover:underline" type="button" onclick="addEmail()">Add another email</button>

                                <div class="mt-4 grid grid-cols-3 gap-x-6 gap-y-8 sm:grid-cols-6" id="address-section">
                                    <div class="sm:col-span-1">
                                        <label for="addresses[0][country_id]"
                                            class="block text-sm/6 font-medium text-gray-900">Country</label>
                                        <div class="mt-2">
                                            <select name="addresses[0][country_id]"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                                                <option value="">Choose a country</option>
                                                @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" {{ old('addresses.0.country_id')==$country->id ?
                                                    'selected' : '' }}>
                                                    {{ $country->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('addresses.0.country_id')
                                            <p class="text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="addresses[0][city]" class="block text-sm/6 font-medium text-gray-900">City</label>
                                        <div class="mt-2">
                                            <input type="text" name="addresses[0][city]" value="{{ old('addresses.0.city') }}"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                        </div>
                                        @error('addresses.0.city')
                                        <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-3">
                                        <label for="addresses[0][street]"
                                            class="block text-sm/6 font-medium text-gray-900">Street name</label>
                                        <div class="mt-2">
                                            <input type="text" name="addresses[0][street]" value="{{ old('addresses.0.street') }}"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                        </div>
                                        @error('addresses.0.street')
                                        <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-2 sm:col-start-1">
                                        <label for="addresses[0][building_number]" class="block text-sm/6 font-medium text-gray-900">Building Number</label>
                                        <div class="mt-2">
                                            <input type="text" name="addresses[0][building_number]" value="{{ old('addresses.0.building_number') }}"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                        </div>
                                        @error('addresses.0.building_number')
                                        <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="addresses[0][apartment_number]" class="block text-sm/6 font-medium text-gray-900">
                                            Apartment Number</label>
                                        <div class="mt-2">
                                            <input type="text" name="addresses[0][apartment_number]" value="{{ old('addresses.0.apartment_number') }}"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                        </div>
                                        @error('addresses[0][apartment_number]')
                                        <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="addresses[0][label]" class="block text-sm/6 font-medium text-gray-900">Label</label>
                                        <div class="mt-2">
                                            <select name="addresses[0][label]" value="{{ old('addresses.0.label') }}"
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
                                <button class="mt-2 text-blue-500 hover:underline" type="button" onclick="addAddress()">Add another address</button>
                            </div>

                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                            <button type="submit"
                                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
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
                    <label for="first-name" class="block text-sm/6 font-medium text-gray-900">Country code</label>
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
                    <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Phone number</label>
                    <div class="mt-2">
                        <input type="text" name="phone_numbers[${index}][phone_number]" value="{{ old('phone_numbers.${index}.phone_number') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                            @error('phone_numbers.${index}.phone_number')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Label</label>
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
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                    <div class="mt-2">
                        <input type="email" name="emails[${index}][email]" value="{{ old('emails.${index}.email') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                    </div>
                    @error('emails.${index}.email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="sm:col-span-2">
                    <label for="label" class="block text-sm/6 font-medium text-gray-900">Label</label>
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
                <div class="sm:col-span-1">
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

                <div class="col-span-3">
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
                    @error('addresses[${index}][apartment_number]')
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


              let companyIndex = 1;

              function addCompany() {
                  const companySection = document.getElementById('company-section');
                  // const companyIndex = companySection.children.length;
                  const newCompany = document.createElement('div');
                  newCompany.classList.add('company');
                  newCompany.dataset.index = companyIndex;

                  newCompany.innerHTML = `
                      <label>Company Name</label>
                      <input type="text" name="companies[${companyIndex}][name]" value="">
                      <div id="job-titles-section-${companyIndex}" class="job-titles-section">
                          <div>
                              <label>Job Title</label>
                              <input type="text" name="companies[${companyIndex}][job_names][0][title]" value="">
                              @error('companies.0.job_names.0.title')
                                 <p class="text-red-500">{{ $message }}</p>
                              @enderror
                          </div>
                      </div>
                  `;
                  companySection.appendChild(newCompany);
                  companyIndex++;
              }

              function addJobTitle(companyIndex) {
                  const jobTitlesSection = document.getElementById(`job-titles-section-${companyIdx}`);
                  const jobTitleCount = jobTitlesSection.querySelectorAll('div').length;

                  // New job title HTML
                  const newJobTitle = document.createElement('div');
                  newJobTitle.innerHTML = `
                      <div>
                          <label>Job Title</label>
                          <input type="text" name="companies[${companyIndex}][job_names][${jobTitleIndex}][title]" value="{{ old('companies.${companyIndex}.job_names.${jobTitleIndex}.title') }}">
                          @error('companies.${companyIndex}.job_names.${jobTitleIndex}.title')
                              <p class="text-red-500">{{ $message }}</p>
                          @enderror
                      </div>
                  `;
                  jobTitlesSection.appendChild(newJobTitle);
              }
    </script>
</x-app-layout>
