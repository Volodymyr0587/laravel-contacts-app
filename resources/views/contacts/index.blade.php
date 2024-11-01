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
                                @php
                                    $firstLetter = strtoupper(substr($contact->first_name, 0, 1));
                                    $isVowel = in_array($firstLetter, ['A', 'E', 'I', 'O', 'U']);
                                    $bgColor = $isVowel ? 'bg-blue-500' : 'bg-yellow-500';
                                @endphp
                                @if ($contact->image)
                                    <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                    src="{{ asset('storage/' . $contact->image) }}"
                                    alt="{{ $contact->first_name }}">
                                @else
                                    <!-- Display initials with background color based on first letter -->
                                    <div class="h-12 w-12 flex-none rounded-full {{ $bgColor }} flex items-center justify-center text-white font-bold text-xl">
                                        {{ $firstLetter }}
                                    </div>
                                @endif
                                <div class="min-w-0 flex-auto">
                                    <div class="flex justify-between items-center gap-x-4 text-sm/6 font-semibold text-gray-900">
                                        <a href="{{ route('contacts.show', $contact) }}" class="hover:underline hover:text-blue-500">
                                            {{ $contact->first_name }} {{ $contact->last_name }}
                                        </a>
                                        <a href="{{ route('contacts.edit', $contact) }}" class="hover:text-blue-500 mb-1">
                                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z" fill="currentColor"></path> </g></svg>
                                        </a>
                                    </div>
                                    {{-- <p class="mt-1 truncate text-xs/5 text-gray-500">{{ optional($contact->phoneNumbers->first())->phone_number }}</p> --}}
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
            </div>
        </div>
    </div>
</x-app-layout>
