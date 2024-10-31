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
            <h3>Fill out the form with information about the contact you want to save.</h3>
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
            <input type="number" name="birthday[day]" value="{{ old('birthday.day') }}">
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
                  @foreach ($labelTypes as $labelType)
                  <option value="{{ $labelType->value }}" {{ old('emails.0.label')==$labelType->value ? 'selected' : ''
                    }}>
                    {{ ucfirst($labelType->value) }}
                  </option>
                  @endforeach
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
                  <option value="{{ $dialCode }}" {{ old('phone_numbers.0.dial_code')==$dialCode ? 'selected' : '' }}>
                    {{ $dialCode }}
                  </option>
                  @endforeach
                </select>

                <label>Phone Number</label>
                <input type="text" name="phone_numbers[0][phone_number]"
                  value="{{ old('phone_numbers.0.phone_number') }}">
                @error('phone_numbers.0.phone_number')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <label>Label</label>
                <select name="phone_numbers[0][label]">
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
            <button type="button" onclick="addPhoneNumber()">Add another phone number</button>

            <!-- Addresses -->
            <h3>Addresses</h3>
            <div id="address-section">
              <div>
                <label>Country</label>
                <select name="addresses[0][country_id]">
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
                <input type="text" name="addresses[0][building_number]"
                  value="{{ old('addresses.0.building_number') }}">
                @error('addresses.0.building_number')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <label>Apartment Number</label>
                <input type="text" name="addresses[0][apartment_number]"
                  value="{{ old('addresses.0.apartment_number') }}">
                @error('addresses.0.apartment_number')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <label>Label</label>
                <select name="addresses[0][label]" value="{{ old('addresses.0.label') }}">
                  <option value="">Select a type</option>
                  @foreach ($labelTypes as $labelType)
                  <option value="{{ $labelType->value }}" {{ old('addresses.0.label')==$labelType->value ? 'selected' :
                    '' }}>
                    {{ ucfirst($labelType->value) }}
                  </option>
                  @endforeach
                </select>
                @error('addresses.0.label')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <button type="button" onclick="addAddress()">Add another address</button>

            <!-- Companies -->
            <h3>Companies</h3>
            <div id="company-section">
              <div>
                <label>Company Name</label>
                <input type="text" name="companies[0][name]" value="{{ old('companies.0.name') }}">
                @error('companies.0.name')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <div id="job-titles-section-0">
                  <div>
                    <label>Job Title</label>
                    <input type="text" name="companies[0][job_names][0][title]"
                      value="{{ old('companies.0.job_names.0.title') }}">
                    @error('companies.0.job_names.0.title')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
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
            const labelOptions = `
                <option value="">Select a type</option>
                @foreach ($labelTypes as $labelType)
                    <option value="{{ $labelType->value }}">{{ ucfirst($labelType->value) }}</option>
                @endforeach
            `;

            emailSection.insertAdjacentHTML('beforeend', `
                <div>
                    <label>Email</label>
                    <input type="email" name="emails[${index}][email]" value="{{ old('emails.${index}.email') }}">
                    @error('emails.${index}.email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <label>Label</label>
                    <select name="emails[${index}][label]" value="{{ old('emails.${index}.label') }}">
                        ${labelOptions}
                    </select>
                    @error('emails.${index}.label')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
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
            addressSection.insertAdjacentHTML('beforeend', `
                <div>
                    <label>Country</label>
                    <select name="addresses[${index}][country_id]">
                        ${countryOptions}
                    </select>
                    @error('addresses.${index}.country_id')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <label>City</label>
                    <input type="text" name="addresses[${index}][city]" value="{{ old('addresses.${index}.city') }}">
                    @error('addresses.${index}.city')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <label>Street</label>
                    <input type="text" name="addresses[${index}][street]" value="{{ old('addresses.${index}.street') }}">
                    @error('addresses.${index}.street')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <label>Building Number</label>
                    <input type="text" name="addresses[${index}][building_number]" value="{{ old('addresses.${index}.building_number') }}">
                    @error('addresses.${index}.building_number')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <label>Apartment Number</label>
                    <input type="text" name="addresses[${index}][apartment_number]" value="{{ old('addresses.${index}.apartment_number') }}">
                    @error('addresses.${index}.apartment_number')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <label>Label</label>
                    <select name="addresses[${index}][label]">
                        ${labelOptions}
                    </select>
                    @error('addresses.${index}.label')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            `);
        }

        function addPhoneNumber() {
            const phoneSection = document.getElementById('phone-section');
            const index = phoneSection.children.length;

            phoneSection.insertAdjacentHTML('beforeend', `
                <div>
                    <label>Country Code</label>
                    <select name="phone_numbers[${index}][dial_code]">
                        @foreach ($dialCodes as $dialCode)
                            <option value="{{ $dialCode }}">{{ $dialCode }}</option>
                        @endforeach
                    </select>

                    <label>Phone Number</label>
                    <input type="text" name="phone_numbers[${index}][phone_number]" value="{{ old('phone_numbers.${index}.phone_number') }}">
                    @error('phone_numbers.${index}.phone_number')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <label>Label</label>
                    <select name="phone_numbers[${index}][label]">
                        <option value="">Select a type</option>
                        <option value="work">Work</option>
                        <option value="home">Home</option>
                        <option value="other">Other</option>
                    </select>
                    @error('phone_numbers.${index}.label')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
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
