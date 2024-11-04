<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $contact->first_name }} {{ $contact->last_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="container mx-auto p-6  rounded-lg shadow-md" style="background: linear-gradient(45deg, {{ $contact->color }}, {{ $contact->color }}90);">
                <!-- Contact Header -->
                <div class="flex items-center justify-between pb-6">
                    <a href="{{ $backUrl }}"
                            class="px-2 py-2 flex items-center justify-center w-10 h-10 rounded-full
                            transition duration-300 ease-in-out hover:bg-gray-300 hover:scale-110">
                        <x-svg.back-arrow />
                    </a>

                    <div class=" flex justify-end gap-4">
                        <!-- Favorite Button -->
                        <form action="{{ route('contacts.toggleFavorite', $contact) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="flex items-center justify-center w-10 h-10 rounded-full
                            transition duration-300 ease-in-out hover:bg-gray-300 hover:scale-110">
                                @if($contact->favorites)
                                <x-svg.favorite :is_favorite=true />
                                @else
                                <x-svg.favorite />
                                @endif
                            </button>
                        </form>

                        <a href="{{ route('contacts.edit', $contact) }}"
                            class="px-5 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700">
                            Edit
                        </a>
                        <form action="{{ route('contacts.destroy', $contact) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this contact?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-2 flex items-center justify-center w-10 h-10 rounded-full
                            transition duration-300 ease-in-out hover:bg-gray-300 hover:scale-110">
                                <x-svg.trash />
                            </button>
                        </form>
                    </div>
                </div>
                <div class="flex items-center justify-between pb-6 border-b border-gray-200">
                    <div class="flex items-center gap-4">
                        <!-- Contact Avatar -->
                        @if ($contact->image)
                        <img src="{{ asset('storage/' . $contact->image) }}" alt="{{ $contact->first_name }}"
                            class="w-36 h-36 rounded-full">
                        @else
                        @php
                            $firstLetter = mb_strtoupper(mb_substr($contact->first_name, 0, 1));
                        @endphp
                        <div class="w-36 h-36 rounded-full border flex items-center justify-center text-8xl font-bold"
                            style="background-color: {{ $contact->color }}; text-shadow: #FFFFFF 1px 0 6px;">
                            {{ $firstLetter }}
                        </div>
                        @endif

                        <!-- Contact Name and Favorite Icon -->
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 drop-shadow-2xl"
                            style="text-shadow: #FFFFFF 1px 0 10px;">{{ $contact->first_name }} {{
                                $contact->middle_name }} {{
                                $contact->last_name }}</h2>
                            {{-- <p class="text-gray-600">{{$contact->nickname}}</p> --}}
                        </div>
                    </div>
                </div>

                <!-- Contact Details Section -->
                <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Basic Info -->
                    <div class="bg-gray-50 p-4 rounded-lg text-gray-700">
                        <h3 class="text-xl font-semibold ">Contact Information</h3>
                        <div class="mt-4">
                            <p><span class="font-semibold text-gray-600">Nickname:</span> {{ $contact->nickname ?? 'N/A'
                                }}</p>
                            <p class="mt-2"><span class="font-semibold text-gray-600">About:</span> {{ $contact->about
                                ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg text-gray-700">
                        <h3 class="text-xl font-semibold">Birthday</h3>
                        <div class="mt-4">
                            @php
                                $birthdayInfo = App\Helpers\BirthdayHelper::formatBirthday($contact->birthday);
                            @endphp
                            <p>
                                <span class="font-semibold text-gray-600">Day:</span> {{ $birthdayInfo['day'] }}
                                <span class="font-semibold text-gray-600">Month:</span> {{ $birthdayInfo['month'] }}
                                <span class="font-semibold text-gray-600">Year:</span> {{ $birthdayInfo['year'] }}
                            </p>
                            @if ($birthdayInfo['day_name'])
                                <p>
                                    {{ $birthdayInfo['day_name'] }} this year {{ date('Y') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Emails -->
                    <div class="bg-gray-50 p-4 rounded-lg text-gray-700">
                        <h3 class="text-xl font-semibold">Emails</h3>
                        <ul class="mt-4 space-y-2">
                            @forelse ($contact->emails as $email)
                            <li class="flex items-center justify-between">
                                <span class="text-gray-600">{{ $email->email }}</span>
                            </li>
                            @empty
                            <li class="text-gray-400">No emails available.</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Phone Numbers -->
                    <div class="bg-gray-50 p-4 rounded-lg text-gray-700">
                        <h3 class="text-xl font-semibold">Phone Numbers</h3>
                        <ul class="mt-4 space-y-2">
                            @forelse ($contact->phoneNumbers as $phoneNumber)
                            <li class="flex items-center justify-between">
                                <span class="text-gray-600">{{ $phoneNumber->dial_code }} {{ $phoneNumber->phone_number }}</span>
                            </li>
                            @empty
                            <li class="text-gray-400">No phone numbers available.</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Addresses -->
                    <div class="bg-gray-50 p-4 rounded-lg text-gray-700">
                        <h3 class="text-xl font-semibold">Addresses</h3>
                        <ul class="mt-4 space-y-2">
                            @forelse ($contact->addresses as $address)
                            <li class=" my-2">
                                <div class="flex items-center gap-4">
                                    <x-icon class="h-8 w-8" name="flag-country-{{ Str::lower($address->country->code) }}" />
                                    <span class="text-gray-800">{{ $address->country->name }}</span>
                                </div>

                                <div class="space-y-1 text-sm mb-2">
                                    <p><span class="font-semibold">City:</span> {{ $address->city ?? 'N/A' }}</p>
                                    <p><span class="font-semibold">Street:</span> {{ $address->street ?? 'N/A' }}</p>
                                    <p><span class="font-semibold">Building number:</span> {{ $address->building_number }}</p>
                                    <p><span class="font-semibold">Apartment number:</span> {{ $address->apartment_number }}</p>
                                    <p><span class="font-semibold">Type:</span> {{ $address->label }}</p>
                                </div>
                            </li>
                            @empty
                            <li class="text-gray-400">No addresses available.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex justify-end gap-4">

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
