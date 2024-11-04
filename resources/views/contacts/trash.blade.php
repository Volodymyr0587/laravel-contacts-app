<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-end gap-4 mb-4">
                        <!-- Favorite Button -->
                        <form action="{{ route('contacts.restore-all') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-5 py-2 bg-green-600 text-white font-bold rounded-full hover:bg-green-700">
                                Restore all
                            </button>
                        </form>
                        <form action="{{ route('contacts.forceDeleteAll') }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to empty trash? This action is irreversible!');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-5 py-2 bg-red-600 text-white font-bold rounded-full hover:bg-red-700">
                                Empty Trash
                            </button>
                        </form>
                    </div>

                    <ul role="list" class="divide-y divide-gray-100">
                        @forelse ($contacts as $contact)
                        <li class="flex justify-between items-center gap-x-6 py-5 px-5 rounded-md hover:bg-gray-100">
                            <div class="flex min-w-0 gap-x-4">
                                @if ($contact->image)
                                <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                    src="{{ asset('storage/' . $contact->image) }}" alt="{{ $contact->first_name }}">
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
                                    <div
                                        class="flex justify-between items-center gap-x-4 text-sm/6 font-semibold text-gray-900">
                                        <p
                                            class="">
                                            {{ $contact->first_name }} {{ $contact->last_name }}
                                        </p>
                                        <form action="{{ route('contacts.restore', $contact) }}" method="POST" class="has-tooltip">
                                            @csrf
                                            <button type="submit" class="flex items-center justify-center w-10 h-10 rounded-full
                                                transition duration-300 ease-in-out hover:bg-gray-300 hover:scale-110 hover:-rotate-90">
                                                <x-svg.restore />
                                            </button>
                                            <span class='tooltip px-5 py-2 shadow-xl bg-green-600 text-white rounded-tl-2xl rounded-br-2xl ml-8 -mt-20'>Restore</span>
                                        </form>
                                        <form action="{{ route('contacts.force-delete', $contact) }}" method="POST" class="has-tooltip"
                                            onsubmit="return confirm('Are you sure you want to delete this contact? This action is irreversible!');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="flex items-center justify-center w-10 h-10 rounded-full
                                                transition duration-300 ease-in-out hover:bg-gray-300 hover:scale-110">
                                                <x-svg.destroy />
                                            </button>
                                            <span class='tooltip px-5 py-2 shadow-xl bg-red-600 text-white rounded-tl-2xl rounded-br-2xl ml-8 -mt-20'>Destroy</span>
                                        </form>
                                    </div>
                                    <p class="mt-1 truncate text-xs/5 text-gray-500">{{
                                        $contact->phoneNumbers->first()->phone_number ?? 'No phone numbers' }}</p>
                                    <p class="mt-1 truncate text-xs/5 text-gray-500">{{ $contact->emails->first()->email
                                        ?? 'No emails' }}</p>
                                </div>
                            </div>
                            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                <p class="text-sm/6 text-gray-900">{{ $contact->jobNames->first()->title ?? 'No job
                                    title' }}</p>
                                <p class="mt-1 text-xs/5 text-gray-500">Deleted at <time datetime="2023-01-23T13:23Z">{{
                                        $contact->deleted_at->format('d-m-Y H:i:s') }}</time></p>
                            </div>
                        </li>
                        @empty
                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex min-w-0 gap-x-4">
                                <x-svg.trash />
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm/6 font-semibold text-gray-900">Trash is empty.</p>
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
