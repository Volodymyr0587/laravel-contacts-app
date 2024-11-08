<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @if(request()->has('search'))
                    {{ __('Search results for') }} <span class="italic underline underline-offset-8 decoration-4 decoration-blue-500">{{ request()->query('search') }}</span>
                @else
                    {{ __('Contacts') }}
                @endif
            </h2>
            <a href="{{ route('export-contacts-to-csv') }}"
                class="px-5 py-2 bg-blue-600 text-white font-bold rounded-full hover:bg-blue-700">
                Download Contacts to CSV file
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Search Form--}}
                <div class="mt-4 ml-4 w-full md:w-72">
                    <form action="{{ route('contacts.index') }}">
                        @csrf
                        <div class="relative h-10 w-full min-w-[200px]">
                            <button type="submit"
                                class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                    </path>
                                </svg>
                            </button>
                            <input name="search" value="{{ request('search') }}"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                                placeholder="Search by name, phone, email" />
                        </div>
                    </form>
                </div>
                {{-- End Search Form --}}

            <div class="p-6 text-gray-900">
                <ul role="list" class="divide-y divide-gray-100">
                    @forelse ($contacts as $contact)
                    <li class="flex justify-between items-center gap-x-6 py-5 px-5 rounded-md"
                        style="transition: background-color 0.3s ease;"
                        onmouseover="this.style.backgroundColor='{{ $contact->color }}30'"
                        onmouseout="this.style.backgroundColor=''">
                        <div class="flex min-w-0 gap-x-4">
                            @php
                            $upcomingBirthdayInfo = $contact->upcomingBirthdayInfo();
                            @endphp
                            <x-birthday-tooltip :upcomingBirthdayInfo="$upcomingBirthdayInfo" />
                            @if ($contact->image)
                            <a href="{{ route('contacts.show', $contact) }}">
                                <img class="h-12 w-12 flex-none rounded-full bg-gray-50 transition duration-300 ease-in-out hover:scale-150"
                                    src="{{ asset('storage/' . $contact->image) }}" alt="{{ $contact->first_name }}">
                            </a>
                            @else
                            @php
                            $firstLetter = mb_strtoupper(mb_substr($contact->first_name, 0, 1));
                            @endphp
                            <!-- Display initials with background color based on first letter -->
                            <a href="{{ route('contacts.show', $contact) }}"
                                class="h-12 w-12 flex-none rounded-full border flex items-center justify-center font-bold text-3xl transition duration-300 ease-in-out hover:scale-150"
                                style="background-color: {{ $contact->color }}; text-shadow: #FFFFFF 1px 0 6px;">
                                {{ $firstLetter }}
                            </a>
                            @endif
                            <div class="min-w-0 flex-auto">
                                <div
                                    class="flex justify-between items-center gap-x-4 text-sm/6 font-semibold text-gray-900">
                                    <a href="{{ route('contacts.show', $contact) }}"
                                        class="hover:underline hover:text-blue-500">
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
                                    <a href="{{ route('contacts.edit', $contact) }}"
                                        class="flex items-center justify-center w-10 h-10 rounded-full
                                            transition duration-300 ease-in-out hover:bg-gray-300 hover:scale-110 hover:rotate-6">
                                        <x-svg.edit />
                                    </a>
                                </div>
                                <p class="mt-1 truncate text-xs/5 text-gray-500">{{
                                    $contact->phoneNumbers->first()->phone_number ?? 'No phone numbers' }}</p>
                                <p class="mt-1 truncate text-xs/5 text-gray-500">{{ $contact->emails->first()->email ??
                                    'No emails' }}</p>
                            </div>
                        </div>
                        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <p class="text-sm/6 text-gray-900">{{ $contact->jobNames->first()->title ?? 'No job title'
                                }}</p>
                            <p class="mt-1 text-xs/5 text-gray-500">Updated at <time datetime="2023-01-23T13:23Z">{{
                                    $contact->updated_at->format('d-m-Y H:i:s') }}</time></p>
                        </div>
                    </li>
                    @empty
                    <li class="flex justify-between gap-x-6 py-5">
                        <div class="flex min-w-0 gap-x-4">
                            <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                src="{{ asset('images/no-image.png') }}" alt="No image">
                            <div class="min-w-0 flex-auto mt-2">
                                <p class="text-sm/6 font-semibold text-gray-900">No contacts.</p>
                            </div>
                        </div>
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
