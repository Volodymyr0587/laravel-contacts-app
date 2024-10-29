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

                        <!-- Basic Information -->
                        <h3>Basic Information</h3>
                        <label>First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}">
                        @error('first_name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror

                        <label>Middle Name</label>
                        <input type="text" name="middle_name" value="{{ old('middle_name') }}">
                        @error('middle_name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror

                        <label>Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}">
                        @error('last_name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror

                        <label>Nickname</label>
                        <input type="text" name="nickname" value="{{ old('nickname') }}">
                        @error('nickname')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror

                        <!-- Birthday -->
                        <h3>Birthday</h3>
                        <label>Day</label>
                        <input type="number" name="birthday[day]" value="{{ old('birthday.day') }}" min="1" max="31">
                        @error('birthday.day')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror

                        <label>Month</label>
                        <input type="number" name="birthday[month]" value="{{ old('birthday.month') }}" min="1" max="12">
                        @error('birthday.month')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror

                        <label>Year</label>
                        <input type="number" name="birthday[year]" value="{{ old('birthday.year') }}" min="1900">
                        @error('birthday.year')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror

                        <!-- Emails -->
                        <h3>Emails</h3>
                        <div id="email-section">
                            <div>
                                <label>Email</label>
                                <input type="email" name="emails[0][email]" value="{{ old('emails.0.email') }}">
                                @error('emails.0.email')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror

                                <label>Label</label>
                                <select name="emails[0][label]" value="{{ old('emails.0.label') }}">
                                    <option value="">Select a type</option>
                                    <option value="work">Work</option>
                                    <option value="home">Home</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('emails.0.label')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="button" onclick="addEmail()">Add another email</button>

                        <!-- Phone Numbers -->
                        <h3>Phone Numbers</h3>
                        <div id="phone-section">
                            <div>
                                <label>Country Code</label>
                                <select name="phone_numbers[0][dial_code]">
                                    @foreach ($dialCodes as $id => $dialCode)
                                        <option value="{{ $dialCode }}" {{ old('phone_numbers.0.dial_code') == $dialCode ? 'selected' : '' }}>
                                            {{ $dialCode }}
                                        </option>
                                    @endforeach
                                </select>

                                <label>Phone Number</label>
                                <input type="text" name="phone_numbers[0][phone_number]" value="{{ old('phone_numbers.0.phone_number') }}">
                                @error('phone_numbers.0.phone_number')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror

                                <label>Label</label>
                                <select name="phone_numbers[0][label]">
                                    <option value="">Select a type</option>
                                    <option value="work">Work</option>
                                    <option value="home">Home</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('phone_numbers.0.label')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="button" onclick="addPhoneNumber()">Add another phone number</button>

                        <!-- Addresses -->
                        <h3>Addresses</h3>
                        <div id="address-section">
                            <div>
                                <label>Country</label>
                                <select name="addresses[0][country_id]">
                                    <option value="">Choose a country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('addresses.0.country_id') == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('addresses.0.country_id')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror

                                <label>City</label>
                                <input type="text" name="addresses[0][city]" value="{{ old('addresses.0.city') }}">
                                @error('addresses.0.city')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror

                                <label>Street</label>
                                <input type="text" name="addresses[0][street]" value="{{ old('addresses.0.street') }}">
                                @error('addresses.0.street')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror

                                <label>Building Number</label>
                                <input type="text" name="addresses[0][building_number]" value="{{ old('addresses.0.building_number') }}">
                                @error('addresses.0.building_number')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror

                                <label>Apartment Number</label>
                                <input type="text" name="addresses[0][apartment_number]" value="{{ old('addresses.0.apartment_number') }}">
                                @error('addresses.0.apartment_number')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror

                                <label>Label</label>
                                <select name="addresses[0][label]" value="{{ old('addresses.0.label') }}">
                                    <option value="">Select a type</option>
                                    <option value="work">Work</option>
                                    <option value="home">Home</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('addresses.0.label')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="button" onclick="addAddress()">Add another address</button>

                        <!-- Companies and Job Titles -->
                        {{-- <h3>Companies</h3>
                        <div id="company-section">
                            <div>
                                <label>Company Name</label>
                                <input type="text" name="companies[0][name]" value="{{ old('companies.0.name') }}">
                                @error('companies.0.name')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror

                                <label>Address</label>
                                <input type="text" name="companies[0][address]" value="{{ old('companies.0.address') }}">
                                @error('companies.0.address')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror

                                <h4>Job Titles</h4>
                                <div>
                                    <label>Job Title</label>
                                    <input type="text" name="job_names[0][title]" value="{{ old('job_names.0.title') }}">
                                    @error('job_names.0.title')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    <input type="hidden" name="job_names[0][company_id]" value="0"> <!-- Placeholder для ID компанії -->
                                </div>
                            </div>
                        </div>
                        <button type="button" onclick="addCompany()">Add another company</button> --}}

                        {{-- <h3>Companies</h3>
                        <div id="company-section">
                            <div>
                                <label>Company Name</label>
                                <input type="text" name="companies[0][name]" value="{{ old('companies.0.name') }}">
                                @error('companies.0.name')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror

                                <label>Address</label>
                                <input type="text" name="companies[0][address]" value="{{ old('companies.0.address') }}">
                                @error('companies.0.address')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror

                                <h4>Job Titles</h4>
                                <div id="job-titles-section-0">
                                    <div>
                                        <label>Job Title</label>
                                        <input type="text" name="job_names[0][title]" value="{{ old('job_names.0.title') }}">
                                        @error('job_names.0.title')
                                            <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                        <input type="hidden" name="job_names[0][company_id]" value="0">
                                    </div>
                                </div>
                                <button type="button" onclick="addJobTitle(0)">Add another job title</button>
                            </div>
                        </div>
                        <button type="button" onclick="addCompany()">Add another company</button> --}}

                        <h3>Companies</h3>
                        {{-- <div id="company-section">
                            <div>
                                <label>Company Name</label>
                                <input type="text" name="companies[0][name]" value="{{ old('companies.0.name') }}">
                                @error('companies.0.name')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror

                                <label>Address</label>
                                <input type="text" name="companies[0][address]" value="{{ old('companies.0.address') }}">
                                @error('companies.0.address')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror

                                <h4>Job Titles</h4>
                                <div id="job-titles-section-0">
                                    <div>
                                        <label>Job Title</label>
                                        <input type="text" name="job_names[0][title]" value="{{ old('job_names.0.title') }}">
                                        @error('job_names.0.title')
                                            <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                        <input type="hidden" name="job_names[0][company_id]" value="0">
                                    </div>
                                </div>
                                <button type="button" onclick="addJobTitle(0)">Add another job title</button>
                            </div>
                        </div>
                        <button type="button" onclick="addCompany()">Add another company</button> --}}
                        <div id="company-section">
                            <div>
                                <label>Company Name</label>
                                <input type="text" name="companies[0][name]" value="{{ old('companies.0.name') }}">

                                <h4>Job Titles</h4>
                                <div id="job-titles-section-0">
                                    <div>
                                        <label>Job Title</label>
                                        <input type="text" name="companies[0][job_names][0][title]" value="{{ old('companies.0.job_names.0.title') }}">
                                        {{-- <input type="hidden" name="companies[0][job_names][0][company_id]" value="0"> --}}
                                    </div>
                                </div>
                                <button type="button" onclick="addJobTitle(0)">Add another job title</button>
                            </div>
                        </div>
                        <button type="button" onclick="addCompany()">Add another company</button>


                        <!-- Submit Button -->
                        <button type="submit">Create Contact</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        function addEmail() {
            const emailSection = document.getElementById('email-section');
            const index = emailSection.children.length;
            emailSection.insertAdjacentHTML('beforeend', `
                <div>
                    <label>Email</label>
                    <input type="email" name="emails[${index}][email]">
                    <label>Label</label>
                    <input type="text" name="emails[${index}][label]">
                </div>
            `);
        }

        function addPhoneNumber() {
            const phoneSection = document.getElementById('phone-section');
            const index = phoneSection.children.length;
            phoneSection.insertAdjacentHTML('beforeend', `
                <div>
                    <label>Country Code</label>
                    <input type="text" name="phone_numbers[${index}][country_code]">
                    <label>Phone Number</label>
                    <input type="text" name="phone_numbers[${index}][phone_number]">
                    <label>Label</label>
                    <input type="text" name="phone_numbers[${index}][label]">
                </div>
            `);
        }

        function addAddress() {
            const addressSection = document.getElementById('address-section');
            const index = addressSection.children.length;
            addressSection.insertAdjacentHTML('beforeend', `
                <div>
                    <label>Country ID</label>
                    <input type="number" name="addresses[${index}][country_id]">
                    <label>City</label>
                    <input type="text" name="addresses[${index}][city]">
                    <label>Street</label>
                    <input type="text" name="addresses[${index}][street]">
                    <label>Building Number</label>
                    <input type="text" name="addresses[${index}][building_number]">
                    <label>Apartment Number</label>
                    <input type="text" name="addresses[${index}][apartment_number]">
                    <label>Label</label>
                    <input type="text" name="addresses[${index}][label]">
                </div>
            `);
        }

        // function addCompany() {
        //     const companySection = document.getElementById('company-section');
        //     const index = companySection.children.length;
        //     companySection.insertAdjacentHTML('beforeend', `
        //         <div>
        //             <label>Company Name</label>
        //             <input type="text" name="companies[${index}][name]">
        //             <label>Address</label>
        //             <input type="text" name="companies[${index}][address]">

        //             <h4>Job Titles</h4>
        //             <div>
        //                 <label>Job Title</label>
        //                 <input type="text" name="job_names[${index}][title]">
        //                 <input type="hidden" name="job_names[${index}][company_id]" value="${index}">
        //             </div>
        //         </div>
        //     `);
        // }

        function addCompany() {
            const companySection = document.getElementById('company-section');
            const index = companySection.children.length;
            companySection.insertAdjacentHTML('beforeend', `
                <div>
                    <label>Company Name</label>
                    <input type="text" name="companies[${index}][name]">
                    <label>Address</label>
                    <input type="text" name="companies[${index}][address]">

                    <h4>Job Titles</h4>
                    <div id="job-titles-section-${index}">
                        <div>
                            <label>Job Title</label>
                            <input type="text" name="job_names[${index}][title]">
                            <input type="hidden" name="job_names[${index}][company_id]" value="${index}">
                        </div>
                    </div>
                    <button type="button" onclick="addJobTitle(${index})">Add another job title</button>
                </div>
            `);
        }

        function addJobTitle(companyIndex) {
            const jobTitlesSection = document.getElementById(`job-titles-section-${companyIndex}`);
            const index = jobTitlesSection.children.length;
            jobTitlesSection.insertAdjacentHTML('beforeend', `
                <div>
                    <label>Job Title</label>
                    <input type="text" name="companies[${companyIndex}][job_names][${index}][title]">
                    <input type="hidden" name="companies[${companyIndex}][job_names][${index}][company_id]" value="${companyIndex}">
                </div>
            `);
        }


    </script>

</x-app-layout>
