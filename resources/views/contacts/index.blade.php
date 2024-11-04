<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contacts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <ul role="list" class="divide-y divide-gray-100">
                        @forelse ($contacts as $contact)
                        <li class="flex justify-between items-center gap-x-6 py-5 px-5 rounded-md hover:bg-gray-100">
                            <div class="flex min-w-0 gap-x-4">
                                @if ($contact->image)
                                    <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                    src="{{ asset('storage/' . $contact->image) }}"
                                    alt="{{ $contact->first_name }}">
                                @else
                                    @php
                                        $firstLetter = strtoupper(substr($contact->first_name, 0, 1));
                                    @endphp
                                    <!-- Display initials with background color based on first letter -->
                                    <div class="h-12 w-12 flex-none rounded-full flex items-center justify-center text-white font-bold text-xl"
                                        style="background-color: {{ $contact->color }};">
                                        {{ $firstLetter }}
                                    </div>
                                @endif
                                <div class="min-w-0 flex-auto">
                                    <div class="flex justify-between items-center gap-x-4 text-sm/6 font-semibold text-gray-900">
                                        <a href="{{ route('contacts.show', $contact) }}" class="hover:underline hover:text-blue-500">
                                            {{ $contact->first_name }} {{ $contact->last_name }}
                                        </a>
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
                                        <a href="{{ route('contacts.edit', $contact) }}" class="flex items-center justify-center w-10 h-10 rounded-full
                                            transition duration-300 ease-in-out hover:bg-gray-300 hover:scale-110 hover:rotate-6">
                                            <x-svg.edit />
                                        </a>
                                    </div>
                                    <p class="mt-1 truncate text-xs/5 text-gray-500">{{ $contact->phoneNumbers->first()->phone_number ?? 'No phone numbers' }}</p>
                                    <p class="mt-1 truncate text-xs/5 text-gray-500">{{ $contact->emails->first()->email ?? 'No emails' }}</p>
                                </div>
                            </div>
                            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                <p class="text-sm/6 text-gray-900">{{ $contact->jobNames->first()->title ?? 'No job title' }}</p>
                                <p class="mt-1 text-xs/5 text-gray-500">Updated at <time datetime="2023-01-23T13:23Z">{{ $contact->updated_at->format('d-m-Y H:i:s') }}</time></p>
                            </div>
                        </li>
                        @empty
                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex min-w-0 gap-x-4">
                                <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                src="{{ asset('images/no-image.png') }}"
                                alt="No image">
                                <div class="min-w-0 flex-auto mt-2">
                                    <p class="text-sm/6 font-semibold text-gray-900">No contacts yet.</p>
                                    {{-- <p class="mt-1 truncate text-xs/5 text-gray-500">leslie.alexander@example.com</p> --}}
                                </div>
                            </div>
                            {{-- <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                <p class="text-sm/6 text-gray-900">Co-Founder / CEO</p>
                                <p class="mt-1 text-xs/5 text-gray-500">Last seen <time datetime="2023-01-23T13:23Z">3h ago</time></p>
                            </div> --}}
                        </li>
                        @endforelse

                    </ul>

                </div>
                <div class="mx-10 my-4">
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
