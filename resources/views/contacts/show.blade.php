<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $contact->first_name }} {{ $contact->last_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
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
                        <div class="w-36 h-36 rounded-full flex items-center justify-center bg-gray-300 text-4xl font-bold text-white"
                            style="background-color: {{ $contact->color }};">
                            {{ strtoupper(substr($contact->first_name, 0, 1)) }}
                        </div>
                        @endif

                        <!-- Contact Name and Favorite Icon -->
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900">{{ $contact->first_name }} {{
                                $contact->middle_name }} {{
                                $contact->last_name }}</h2>
                            {{-- <p class="text-gray-600">{{$contact->nickname}}</p> --}}
                        </div>
                    </div>
                </div>

                <!-- Contact Details Section -->
                <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Basic Info -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-700">Contact Information</h3>
                        <div class="mt-4">
                            <p><span class="font-semibold text-gray-600">Nickname:</span> {{ $contact->nickname ?? 'N/A'
                                }}</p>
                            <p class="mt-2"><span class="font-semibold text-gray-600">About:</span> {{ $contact->about
                                ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Emails -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-700">Emails</h3>
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
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-700">Phone Numbers</h3>
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
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-700">Addresses</h3>
                        <ul class="mt-4 space-y-2">
                            @forelse ($contact->addresses as $address)
                            <li class="text-gray-600">
                                {{ $address->street }}, {{ $address->city }}, {{ $address->state }}, {{
                                $address->postal_code }}
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
